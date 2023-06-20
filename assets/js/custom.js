const myModal = new bootstrap.Modal(document.querySelector("#modalEvento"));
const titulo = document.querySelector("#titulo");
const fecha_inicio = document.querySelector("#fecha_inicio");
const fecha_fin = document.querySelector("#fecha_fin");
const color = document.querySelector("#color");
const id_evento = document.querySelector("#id_evento");
const btnSave = document.querySelector("#btnSave");
const modalTitleId = document.querySelector("#modalTitleId");
const btnEliminar = document.querySelector("#btnEliminar");
document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");
  var calendar = new FullCalendar.Calendar(calendarEl, {
    timeZone: "local",
    initialView: "dayGridMonth",
    locale: "es",
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,listWeek,multiMonthYear",
    },
    //listar los enventos en el calendario
    events: "http://localhost/eventos/ajax/eventos.php?action=list",
    //poner editable para drag and drop
    editable: true,

    dateClick: function (info) {
      fecha_inicio.value = info.dateStr;
      id_evento.value = "";
      titulo.value = "";
      fecha_fin.value = "";
      color.value = "";
      btnSave.textContent = "Registrar";
      modalTitleId.textContent = "Registrar Agenda";
      btnEliminar.classList.add('d-none');
      myModal.show();
    },

    eventClick: function (info) {
        console.log(info);
        id_evento.value = info.event.id;
        titulo.value = info.event.title;
        fecha_inicio.value = info.event.startStr;
        fecha_fin.value = info.event.endStr;
        color.value = info.event.backgroundColor;
        btnSave.textContent = 'Modificar';
        modalTitleId.textContent = 'Actualizar Evento';
        btnEliminar.classList.remove('d-none');
        myModal.show();
    },
    eventDrop: function (info) {
        fetch("http://localhost/eventos/ajax/eventos.php?action=update", {
        method: "POST",
        body: JSON.stringify({
          fecha_inicio: info.event.startStr,
          fecha_fin: info.event.endStr,
          id_evento: info.event.id,
        }),
      })
        .then((res) => res.json())
        .catch((error) => console.error("Error:", error))
        .then(function (info) {
          console.log(info);
          Swal.fire("Avisos?", info.msg, info.type);
          if (info.type) {
            myModal.hide();
            calendar.refetchEvents();
          }
        });
    }
  });
  calendar.render();

  btnSave.addEventListener("click", function () {
    if (
      titulo.value == "" ||
      fecha_inicio.value == "" ||
      fecha_fin.value == "" ||
      color.value == ""
    ) {
      Swal.fire("Avisos?", "Todo los campos son obligatorios", "warning");
    } else {
      fetch("http://localhost/eventos/ajax/eventos.php?action=save", {
        method: "POST",
        body: JSON.stringify({
          titulo: titulo.value,
          fecha_inicio: fecha_inicio.value,
          fecha_fin: fecha_fin.value,
          color: color.value,
          id_evento: id_evento.value,
        }),
      })
        .then((res) => res.json())
        .catch((error) => console.error("Error:", error))
        .then(function (info) {
          console.log(info);
          Swal.fire("Avisos?", info.msg, info.type);
          if (info.type) {
            myModal.hide();
            calendar.refetchEvents();
          }
        });
    }
  });

  btnEliminar.addEventListener("click", function () {
    myModal.hide();
    Swal.fire({
      title: "Advertencia?",
      text: "Esta seguro de eliminar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("http://localhost/eventos/ajax/eventos.php?action=delete&id=" + id_evento.value)
        .then((res) => res.json())
        .catch((error) => console.error("Error:", error))
        .then(function (info) {
          console.log(info);
          Swal.fire("Avisos?", info.msg, info.type);
          if (info.type) {
            calendar.refetchEvents();
          }
        });
      }
    });
  });
});
