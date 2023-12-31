let startingSyntax = "";
let editor;
//keyboard features
document.addEventListener("keydown", function (event) {
  if (event.ctrlKey && event.key === "Enter") {
    executeCode();
  } else if (event.ctrlKey && event.key === "s") {
    saveCode();
    event.preventDefault();
  } else if (event.shiftKey && event.key === "Tab") {
    switchLanguage();
    event.preventDefault();
    console.log("event");
  }
});
window.onload = function () {
  editor = ace.edit("editor");
  editor.setTheme("ace/theme/github_dark");
  editor.setOptions({
    enableBasicAutocompletion: true,
    enableSnippets: true,
    enableLiveAutocompletion: true,
  });
};
function saveCode() {
  const code = editor.getSession().getValue();
  if (code == "") {
    alert("Enter some value to save.");
    return;
  } else if (code == startingSyntax) {
    alert("Enter some value to save.");
    return;
  } else {
    const language = $("#languages").val();
    const data = {
      code: code,
      language: language,
    };
    $.ajax({
      url: "saveCode.php",
      method: "POST",
      data: data,
      success: function (response) {
        console.log(response);
        alert("Code saved successfully!");
      },
      error: function (error) {
        console.error(error);
        alert("Failed to save code.");
      },
    });
  }
}

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
function switchLanguage() {
  let currentLanguage = $("#languages").val();
  const languages = ["none", "c", "cpp", "php", "java", "py", "sql"];
  const currentIndex = languages.indexOf(currentLanguage);
  const nextIndex = (currentIndex + 1) % languages.length;
  const nextLanguage = languages[nextIndex];
  $("#languages").val(nextLanguage);
  changeLanguage();
}
function changeLanguage() {
  let language = $("#languages").val();
  if (language == "c") {
    document.querySelector("#customInput").style.display = "block";
    startingSyntax =
      "#include<stdio.h>\n\nint main() {\n    // Your C code here\n    return 0;\n}";
    editor.session.setMode("ace/mode/c_cpp");
  } else if (language == "cpp") {
    document.querySelector("#customInput").style.display = "block";
    startingSyntax =
      "#include<iostream>\n\nusing namespace std;\n\nint main() {\n    // Your C++ code here\n    return 0;\n}";
    editor.session.setMode("ace/mode/c_cpp");
  } else if (language == "php") {
    document.querySelector("#customInput").style.display = "block";
    startingSyntax = "<?php\n\n// Your PHP code here\n?>";
    editor.session.setMode("ace/mode/php");
  } else if (language == "java") {
    document.querySelector("#customInput").style.display = "block";
    startingSyntax =
      'public class Main\n{\n   public static void main(String[] args) {\n   System.out.println("Hello World");\n   }\n}';
    editor.session.setMode("ace/mode/java");
  } else if (language == "py") {
    document.querySelector("#customInput").style.display = "block";
    startingSyntax = "# Your Python code here";
    editor.session.setMode("ace/mode/python");
  } else if (language == "sql") {
    document.querySelector(".inputSystem").style.display = "none";
    startingSyntax = "# Your SQL queries here";
    editor.session.setMode("ace/mode/sql");
  }
  editor.setValue(startingSyntax);
  editor.clearSelection();
}
// function toggleTheme() {
//   const body = document.body;
//   if (body.classList.contains('dark-theme')) {
//       body.classList.remove('dark-theme');
//   } else {
//       body.classList.add('dark-theme');
//   }
// }

const inputTextarea = document.querySelector("#inputArea");
function executeCode() {
  clearOutput();
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
        var outputElement = document.createElement("div");
        outputElement.innerHTML = response;
        document.querySelector(".output").appendChild(outputElement);
        document.querySelector("#loader").style.display = "none";
        console.log(response);
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
        var outputElement = document.createElement("div");
        outputElement.innerHTML = response;
        document.querySelector(".output").appendChild(outputElement);
        // $(".output").text(response);
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
