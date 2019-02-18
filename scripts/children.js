
function Confirm(title, msg, $true, $false, $btnName, $link) { /*change*/
  var $content = "<div class='dialog-ovelay'>" +
    "<div class='dialog'><header>" +
        " <h3> " + title + " </h3> " +
        "<i class='fa fa-close'></i>" +
      "</header>" +
      "<div class='dialog-msg'>" +
        " <p> " + msg + " </p> " +
      "</div>" +
      "<footer>" +
        "<div class='controls'>" +
          "<form  method='post' autocomplete='off'>" +
            " <button type='submit' name='"+$btnName+"' formaction='"+$link+"' " +
              "name='delete-child-submit' class='button button-danger doAction'>" +
                $true + "</button> " +
            " <button class='button button-default cancelAction'>" + $false + "</button> " +
          "</form>"+
        "</div>" +
      "</footer>" +
      "</div>" +
    "</div>";
  $('body').prepend($content);
  // $('.doAction').click(function () {
  //   window.location.href = $link; /*new*/
  //   $(this).parents('.dialog-ovelay').fadeOut(500, function () {
  //     $(this).remove();
  //   });
  // });
  $('.cancelAction, .fa-close').click(function () {
    $(this).parents('.dialog-ovelay').fadeOut(500, function () {
      $(this).remove();
    });
  });

}
