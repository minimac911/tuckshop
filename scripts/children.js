
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


function changeOptions(inputGr, inputCl) {
  var optionsGrade = ["Hedgehogs", "Squirrel"];
  var grade = document.getElementById("drop-down-grade").value;
  if (inputGr !== undefined) {
      grade = inputGr+'';
  }

  switch (grade) {
      case 'RR'://hedge hogs and squirels
          optionsGrade = ["Hedgehogs", "Squirrel"];
          break;
      case 'R'://red blue yellow green
          optionsGrade = ["Red", "Blue", "Yellow", "Green"];
          break;
      case '1'://j c r s 
      case '2':
          optionsGrade = ["J", "C", "R", "S"];
          break;
      case '3'://j c r 
      case '4':
      case '5':
      case '6':
          optionsGrade = ["J", "C", "R"];
          break;
  }
  // get reference to select element
  var sel = document.getElementById('drop-down-class');

  for (let i = sel.options.length - 1; i >= 1; i--) { 
      sel.remove(i);
  }

  for (let i = 0; i < optionsGrade.length; i++) {
      // create new option element
      var opt = document.createElement('option');

      // create text node to add to option element (opt)
      opt.appendChild(document.createTextNode(optionsGrade[i]));

      // set value property of opt
      opt.value = optionsGrade[i];

      if (inputCl !== undefined && inputCl == optionsGrade[i]) {
          opt.selected = true;
      }

      // add opt to end of select box (sel)
      sel.appendChild(opt);
  }
}