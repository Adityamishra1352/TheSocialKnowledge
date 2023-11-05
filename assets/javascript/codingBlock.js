let editor;
window.onload = function () {
  editor = ace.edit("editor");
  editor.setTheme("ace/theme/github");
  editor.session.setMode("ace/mode/c_cpp");
};
function changeLanguage() {
  let language = $("#languages").val();
  if (language == "c" || language == "cpp") {
    editor.session.setMode("ace/mode/c_cpp");
    document.querySelector(".codeEditor").style.display = "flex";
    document.querySelector(".htmlcssjs_container").style.display = "none";
  } else if (language == "php") {
    editor.session.setMode("ace/mode/php");
    document.querySelector(".codeEditor").style.display = "flex";
    document.querySelector(".htmlcssjs_container").style.display = "none";
  } else if (language == "nodejs") {
    editor.session.setMode("ace/mode/javascript");
    document.querySelector(".codeEditor").style.display = "flex";
    document.querySelector(".htmlcssjs_container").style.display = "none";
  } else if (language == "python") {
    editor.session.setMode("ace/mode/python");
    document.querySelector(".codeEditor").style.display = "flex";
    document.querySelector(".htmlcssjs_container").style.display = "none";
  } else if (language == "htmlcssjs") {
    document.querySelector(".codeEditor").style.display = "none";
    document.querySelector(".htmlcssjs_container").style.display = "block";
  }
}
function compileHTMLCode() {
  const htmlCode = document.getElementById("htmlInput").value;
  const cssCode = document.getElementById("cssInput").value;
  const jsCode = document.getElementById("jsInput").value;
  const output = document.getElementById("outputHTML");
  const iframe = document.createElement("iframe");
  iframe.style.display = "none";
  document.body.appendChild(iframe);
  const doc = iframe.contentDocument;
  doc.open();
  doc.write(`<style>${cssCode}</style>${htmlCode}`);
  doc.close();
  const script = doc.createElement("script");
  script.text = jsCode;
  doc.body.appendChild(script);
  output.innerHTML = doc.documentElement.outerHTML;
  document.body.removeChild(iframe);
}
var radioValue = null;
const radio1 = document.getElementById("inlineRadio1");
const radio2 = document.getElementById("inlineRadio2");
const inputArea = document.getElementById("inputArea");
radio1.addEventListener("change", function () {
  if (radio1.checked) {
    radioValue = "yes";
  }
});

radio2.addEventListener("change", function () {
  if (radio2.checked) {
    radioValue = "no";
  }
});

function executeCode() {
  if (radioValue != null) {
    console.log(radioValue);
    if (radioValue == "no") {
      $.ajax({
        url: "../test/compiler.php",
        method: "POST",
        data: {
          language: $("#languages").val(),
          code: editor.getSession().getValue(),
        },
        success: function (response) {
          $(".output").text(response);
        },
      });
    } else if (radioValue == "yes") {
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
        },
      });
    }
  }
  else{
    document.querySelector(".input-warning").style.display="block";
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
