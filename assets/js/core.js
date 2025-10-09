const showToast = (args) => {
  $("#infoToast").addClass(`text-center ${args.class}`);
  $(".html").html(`<strong>${args.message}</strong>`);
  $("#infoToast").toast("show");

  setTimeout(() => {
    $("#infoToast").removeClass(
      "bg-gradient-danger",
      "bg-gradient-success",
      "bg-gradient-warning"
    );
  }, "2000");
};

const hoje = new Date().toISOString().slice(0, 10);
const dataVisto = localStorage.getItem("aniversario_visto");

const clearNotification = () => {
  localStorage.setItem("aniversario_visto", hoje);
  showToast({
    class: 'bg-gradient-success',
    message: 'Notificação marcada como vista'
  });
};

const checkNewBirths = () => {
  // Se já foi visto hoje, não faz nada
  if (dataVisto === hoje) {
    console.log("Notificação já vista hoje");
    return;
  }

  $.post("../php/back_client.php", {
    action: "check_new_births",
  }).done(function (response) {
    const data = JSON.parse(response);
    let count = 0;

    data.forEach((item) => {
      count = item.count;
    });

    $("#birthNotification").addClass("rounded-3 bg-gradient-danger px-2");
    $("#birthNotification").html(count);
    $("#notify-message").html(
      "Existem " + count + " cadastros a serem aprovados"
    );

    // Só toca o som se houver notificações novas
    if (count > 0) {
      triggerNotificationAudio();
    }
  });
};

const triggerNotificationAudio = () => {
  const audio = new Audio("../assets/audio/notification.mp3");
  audio.play();
};

