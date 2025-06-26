const showToast = (args) => {
  $("#infoToast").addClass(`text-center ${args.class}`);
  $(".html").html(`<strong>${args.message}</strong>`);
  $("#infoToast").toast("show");

  setTimeout(() => {
    $("#infoToast").removeClass('bg-gradient-danger','bg-gradient-success','bg-gradient-warning')
  }, "2000");
};
