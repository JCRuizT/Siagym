$(document).ready(function(){
    loadSchedules();

    $("#form-schedule").submit(function(e){
        e.preventDefault();
        saveSchedule();
    });

    $("#add-time-slot").click(function(){
        addTimeSlotRow();
    });
});

function loadSchedules(){
    $.ajax({
        data: { "send-get-schedules": "1" },
        async: true,
        url: $("#form-schedule").attr("action"),
        type: 'post',
        dataType: "json",
        beforeSend: function(){
            $("#schedule-list").html("<div class='divContent center-horizontal-margin black'>Cargando...</div>");
        },
        success: function(response){
            if(response.validar == 1 && response.aviso.length > 0){
                var html = "<table class='schedule-table'><tr><th>ID</th><th>Rol</th><th>Días</th><th>Rango Horario</th><th>Estado</th><th>Editar</th><th>Activar/Desactivar</th></tr>";
                $.each(response.aviso, function(i, s){
                    var roleName = s.role == 1 ? "Aprendiz" : (s.role == 2 ? "Funcionario" : "Rol " + s.role);
                    var dayNames = {0:"Dom",1:"Lun",2:"Mar",3:"Mié",4:"Jue",5:"Vie",6:"Sáb"};
                    var daysStr = "";
                    $.each(s.days, function(j, d){
                        daysStr += dayNames[d] + " ";
                    });
                    var rangesStr = "";
                    $.each(s.times, function(j, t){
                        if(j > 0) rangesStr += ", ";
                        rangesStr += t.start_time.substring(0,5) + "-" + t.end_time.substring(0,5);
                    });
                    var estadoLabel = s.estado == 1 ? "Activo" : "Inactivo";
                    var toggleLabel = s.estado == 1 ? "Desactivar" : "Activar";
                    html += "<tr><td>" + s.id + "</td><td>" + roleName + "</td><td>" + daysStr + "</td><td>" + rangesStr + "</td><td>" + estadoLabel + "</td><td><span class='btn' onclick='editSchedule(" + s.id + ")'>Editar</span></td><td><span class='btn' onclick='toggleSchedule(" + s.id + ")'>" + toggleLabel + "</span></td></tr>";
                });
                html += "</table>";
                $("#schedule-list").html(html);
            }else{
                $("#schedule-list").html("<div class='divContent center-horizontal-margin black'>No hay plantillas de horario registradas</div>");
            }
        }
    });
}

function addTimeSlotRow(start, end){
    start = start || "";
    end = end || "";

    var html = "<tr class='time-slot-row'>";
    html += "<td><input type='time' name='time_start[]' class='time-start' value='" + start + "' required></td>";
    html += "<td><input type='time' name='time_end[]' class='time-end' value='" + end + "' required></td>";
    html += "<td><button type='button' class='btn' onclick='removeTimeSlotRow(this)'>X</button></td>";
    html += "</tr>";
    $("#time-slots-body").append(html);
}

function removeTimeSlotRow(btn){
    $(btn).closest("tr").remove();
}

function saveSchedule(){
    var role = $("#role").val();
    if(role == 0){
        $("#response").html("<div class='divContent center-margin center-horizontal-margin error'>Seleccione un rol</div>");
        return;
    }

    if($("input[name='days[]']:checked").length == 0){
        $("#response").html("<div class='divContent center-margin center-horizontal-margin error'>Seleccione al menos un día</div>");
        return;
    }

    if($(".time-slot-row").length == 0){
        $("#response").html("<div class='divContent center-margin center-horizontal-margin error'>Agregue al menos un rango horario</div>");
        return;
    }

    var formData = new FormData(document.getElementById("form-schedule"));

    var isUpdate = $("#schedule-id").val() != "";
    if(isUpdate){
        formData.set("send-schedule-update", "1");
    }else{
        formData.set("send-schedule-create", "1");
    }

    if(!document.getElementById("active").checked){
        formData.append("active", "0");
    }

    $.ajax({
        data: formData,
        async: true,
        url: $("#form-schedule").attr("action"),
        type: 'post',
        dataType: "json",
        contentType: false,
        processData: false,
        beforeSend: function(){
            $("#response").html("<div class='divContent center-horizontal-margin black'>Procesando...</div>");
        },
        success: function(response){
            if(response.validar == 1){
                $("#form-schedule")[0].reset();
                $("#schedule-id").val("");
                $(".time-slot-row").remove();
                $("#btn-cancel").hide();
                $("#response").html("<div class='divContent center-margin center-horizontal-margin success'>" + response.aviso + "</div>");
                loadSchedules();
                setTimeout(function(){
                    var resp = document.getElementById("response");
                    var div = $(".divContent")[0];
                    if(resp && div) resp.removeChild(div);
                }, 3000);
            }else{
                $("#response").html("<div class='divContent center-margin center-horizontal-margin error'>" + response.aviso + "</div>");
            }
        }
    });
}

function editSchedule(id){
    $.ajax({
        data: { "send-get-schedules": "1" },
        async: true,
        url: $("#form-schedule").attr("action"),
        type: 'post',
        dataType: "json",
        beforeSend: function(){
            $("#response").html("<div class='divContent center-horizontal-margin black'>Cargando...</div>");
        },
        success: function(response){
            if(response.validar == 1){
                var schedule = null;
                $.each(response.aviso, function(i, s){
                    if(s.id == id) schedule = s;
                });

                if(!schedule){
                    $("#response").html("<div class='divContent center-margin center-horizontal-margin error'>Plantilla no encontrada</div>");
                    return;
                }

                $("#role").val(schedule.role);
                $("#schedule-id").val(schedule.id);

                $("input[name='days[]']").prop("checked", false);
                $.each(schedule.days, function(i, d){
                    $("input[name='days[]'][value='" + d + "']").prop("checked", true);
                });

                $(".time-slot-row").remove();
                var seen = {};
                $.each(schedule.times, function(i, t){
                    var key = t.start_time + '-' + t.end_time;
                    if(!seen[key]){
                        seen[key] = true;
                        addTimeSlotRow(t.start_time.substring(0,5), t.end_time.substring(0,5));
                    }
                });

                if(schedule.active == 1){
                    $("#active").prop("checked", true);
                }else{
                    $("#active").prop("checked", false);
                }

                $("#btn-cancel").show();
                $("#response").html("");
                $("html, body").animate({ scrollTop: 0 }, 500);
            }
        }
    });
}

function toggleSchedule(id){
    $.ajax({
        data: { "send-schedule-toggle": "1", "id": id },
        async: true,
        url: $("#form-schedule").attr("action"),
        type: 'post',
        dataType: "json",
        beforeSend: function(){
            $("#response").html("<div class='divContent center-horizontal-margin black'>Procesando...</div>");
        },
        success: function(response){
            if(response.validar == 1){
                $("#response").html("<div class='divContent center-margin center-horizontal-margin success'>" + response.aviso + "</div>");
                loadSchedules();
                setTimeout(function(){
                    var resp = document.getElementById("response");
                    var div = $(".divContent")[0];
                    if(resp && div) resp.removeChild(div);
                }, 3000);
            }else{
                $("#response").html("<div class='divContent center-margin center-horizontal-margin error'>" + response.aviso + "</div>");
            }
        }
    });
}

function cancelEdit(){
    $("#form-schedule")[0].reset();
    $("#schedule-id").val("");
    $(".time-slot-row").remove();
    $("#btn-cancel").hide();
    $("#response").html("");
}
