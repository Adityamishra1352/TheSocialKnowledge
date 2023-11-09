let editor;
window.onload = function () {
  editor = ace.edit("editor");
  editor.setTheme("ace/theme/github");
  editor.session.setMode("ace/mode/c_cpp");
};
function changeTheme(){
  let theme=$("#theme").val();
  if(theme=="github"){
    editor.setTheme("ace/theme/github");
  }else if(theme=="chaos"){
    editor.setTheme("ace/theme/chaos");
  }else if(theme=="cobalt"){
    editor.setTheme("ace/theme/cobalt");
  }
  else if(theme=="nord_dark"){
    editor.setTheme("ace/theme/nord_dark");
  }
  else if(theme=="monokai"){
    editor.setTheme("ace/theme/monokai");
  }
  else if(theme=="sqlserver"){
    editor.setTheme("ace/theme/sqlserver");
  }
}
function changeLanguage() {
  let language = $("#languages").val();
  if (language == "c" || language == "cpp") {
    editor.session.setMode("ace/mode/c_cpp");
    document.querySelector(".codeEditor").style.display = "flex";
  } else if (language == "php") {
    editor.session.setMode("ace/mode/php");
    document.querySelector(".codeEditor").style.display = "flex";
  } else if (language == "nodejs") {
    editor.session.setMode("ace/mode/javascript");
    document.querySelector(".codeEditor").style.display = "flex";
  } else if (language == "python") {
    editor.session.setMode("ace/mode/python");
    document.querySelector(".codeEditor").style.display = "flex";
  }
}
const inputTextarea=document.querySelector("#inputArea");
function executeCode() {
    document.querySelector("#loader").style.display="flex";
    if (inputTextarea.value != null) {
      $.ajax({
        url: "../codeTests/codeAlongCompiler.php",
        method: "POST",
        data: {
          language: $("#languages").val(),
          code: editor.getSession().getValue(),
          input: inputTextarea.value,
        },
        success: function (response) {
          $(".output").text(response);
          document.querySelector("#loader").style.display="none";
        },
      });
    }else{
      $.ajax({
        url: "../codeTests/codeAlongCompiler.php",
        method: "POST",
        data: {
          language: $("#languages").val(),
          code: editor.getSession().getValue(),
        },
        success: function (response) {
          $(".output").text(response);
          document.querySelector("#loader").style.display="none";
        },
      });
    }
}
function changeEditorFontSize() {
  const editor = ace.edit("editor");
  const fontSize = parseInt(fontSizeInput.value);

  if (fontSize >= 13 && fontSize <= 30) {
    editor.setFontSize(fontSize + "px");
  } else {
    alert("Font size must be between 10 and 30.");
  }
}
function clearCompiler() {
  editor = ace.edit("editor");
  editor.setValue("");
}
function clearOutput() {
  const output = document.querySelector(".output");
  output.innerHTML = "";
}
