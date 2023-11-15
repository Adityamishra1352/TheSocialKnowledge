let editor;
window.onload = function () {
  editor = ace.edit("editor");
  editor.setTheme("ace/theme/github_dark");
  editor.session.setMode("ace/mode/nodejs");
};
function changeTheme() {
  let theme = $("#theme").val();
  if (theme == "github") {
    editor.setTheme("ace/theme/github_dark");
  } else if (theme == "chaos") {
    editor.setTheme("ace/theme/chaos");
  } else if (theme == "cobalt") {
    editor.setTheme("ace/theme/cobalt");
  } else if (theme == "nord_dark") {
    editor.setTheme("ace/theme/nord_dark");
  } else if (theme == "monokai") {
    editor.setTheme("ace/theme/monokai");
  } else if (theme == "sqlserver") {
    editor.setTheme("ace/theme/sqlserver");
  } else if (theme == "xcode") {
    editor.setTheme("ace/theme/xcode");
  } else if (theme == "twilight") {
    editor.setTheme("ace/theme/twilight");
  } else if (theme == "one_dark") {
    editor.setTheme("ace/theme/one_dark");
  } else if (theme == "merbivore") {
    editor.setTheme("ace/theme/merbivore");
  } else if (theme == "dawn") {
    editor.setTheme("ace/theme/dawn");
  }
}
function changeLanguage() {
  let language = $("#languages").val();
  if (language == "c" || language == "cpp") {
    editor.session.setMode("ace/mode/c_cpp");
  } else if (language == "php") {
    editor.session.setMode("ace/mode/php");
  } else if (language == "js") {
    editor.session.setMode("ace/mode/javascript");
  } else if (language == "py") {
    editor.session.setMode("ace/mode/python");
  }
}
const inputTextarea = document.querySelector("#inputArea");
function executeCode() {
  document.querySelector("#loader").style.display = "flex";
  inputValue = inputTextarea.value;
  if (inputValue !== "") {
    $.ajax({
      url: "../test/compiler.php",
      method: "POST",
      data: {
        language: $("#languages").val(),
        code: editor.getSession().getValue(),
        input: inputArea.value,
      },
      success: function (response) {
        $(".output").text(response);
        document.querySelector("#loader").style.display = "none";
      },
    });
  } else {
    $.ajax({
      url: "../test/compiler.php",
      method: "POST",
      data: {
        language: $("#languages").val(),
        code: editor.getSession().getValue(),
      },
      success: function (response) {
        $(".output").text(response);
        document.querySelector("#loader").style.display = "none";
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
