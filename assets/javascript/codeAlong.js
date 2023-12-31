let editor;
//full screen feature
function openFullscreen() {
  const elem = document.documentElement;
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) {
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) {
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) {
    elem.msRequestFullscreen();
  }
}
function exitFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) {
    document.msExitFullscreen();
  }
}
function exitWindow() {
  $.ajax({
    type: "POST",
    url: "unset_session.php",
    dataType: "json",
    success: function (response) {
      if (response.success) {
        window.location.href = `../test.php`;
      } else {
      }
    },
    error: function () {
      console.error("Error in AJAX request.");
    },
  });
  window.location.href = `../test.php`;
}
var fullScreenModal = new bootstrap.Modal(
  document.querySelector(".fullScreenModal")
);
var gobackModal = new bootstrap.Modal(document.querySelector(".gobackModal"));
var timeModal = new bootstrap.Modal(document.querySelector(".timemodal"));
window.onload = function () {
  fullScreenModal.show();
  document.querySelector("#fullScreen_btn").onclick = () => {
    openFullscreen();
    fullScreenModal.hide();
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/chaos");
  };
};

//full screen when disabled
document.addEventListener("fullscreenchange", function () {
  if (!document.fullscreenElement) {
    fullScreenModal.show();
  }
});
//change theme for the editor feature
function changeTheme() {
  let theme = $("#theme").val();
  if (theme == "github") {
    editor.setTheme("ace/theme/github");
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
  }
}
//change programming language feature
function changeLanguage() {
  let language = $("#languages").val();
  let startingSyntax = "";

  if (language == "c") {
    startingSyntax =
      "#include<stdio.h>\n\nint main() {\n    // Your C code here\n    return 0;\n}";
    editor.session.setMode("ace/mode/c_cpp");
    document.querySelector(".codeEditor").style.display = "flex";
  } else if (language == "cpp") {
    startingSyntax =
      "#include<iostream>\n\nusing namespace std;\n\nint main() {\n    // Your C++ code here\n    return 0;\n}";
    editor.session.setMode("ace/mode/c_cpp");
    document.querySelector(".codeEditor").style.display = "flex";
  } else if (language == "php") {
    startingSyntax = "<?php\n\n// Your PHP code here\n?>";
    editor.session.setMode("ace/mode/php");
    document.querySelector(".codeEditor").style.display = "flex";
  } else if (language == "nodejs") {
    startingSyntax = "// Your JavaScript (Node.js) code here";
    editor.session.setMode("ace/mode/javascript");
    document.querySelector(".codeEditor").style.display = "flex";
  } else if (language == "python") {
    startingSyntax = "# Your Python code here";
    editor.session.setMode("ace/mode/python");
    document.querySelector(".codeEditor").style.display = "flex";
  }
  editor.setValue(startingSyntax);
}

//test answer submit feature
function submitCode() {
  document.querySelector(".loader").style.display = "flex";
  $.ajax({
      url: "../codeTests/codeAlongSubmitCompiler.php",
      method: "POST",
      data: {
          language: $("#languages").val(),
          code: editor.getSession().getValue(),
          question_id: question_id,
          test_id: test_id,
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        document.querySelector(".loader").style.display = "none";
        document.querySelector("#submitCode").disabled = true;
        // gobackModal.show();
        const testResults = response.test_case_results;
        testResults.forEach((testCase, index) => {
            const testCaseElement = document.createElement("div");
            testCaseElement.classList.add("test-case");
            testCaseElement.innerHTML = `Test Case ${index + 1}:`;
            document.getElementById("testCasearea").appendChild(testCaseElement);
            const resultMark = document.createElement("span");
            resultMark.innerHTML = testCase.is_correct ? " &#10004;" : " &#10008;";
            resultMark.style.color = testCase.is_correct ? "green" : "red";
            testCaseElement.appendChild(resultMark);
        });
        setTimeout(function () {
          gobackModal.show();
        }, 5000);
    },       
  });
}

// ...

//test answer custom input feature
const inputTextarea = document.querySelector("#inputArea");
function executeCode() {
  document.querySelector("#loader").style.display = "flex";
  var inputTextAreaValue = inputTextarea.value;
  console.log(inputTextAreaValue);
  if (inputTextAreaValue !== "") {
    $.ajax({
      url: "../codeTests/codeAlongCompiler.php",
      method: "POST",
      data: {
        language: $("#languages").val(),
        code: editor.getSession().getValue(),
        input: inputTextarea.value,
        question_id: question_id,
      },
      success: function (response) {
        document.querySelector(".outputScreen").style.display = "block";
        $(".inputGiven").text(inputTextAreaValue);
        $(".output").text(response);
        document.querySelector("#loader").style.display = "none";
      },
    });
  } else {
    $.ajax({
      url: "../codeTests/codeAlongCompiler.php",
      method: "POST",
      data: {
        language: $("#languages").val(),
        code: editor.getSession().getValue(),
        question_id: question_id,
      },
      success: function (response) {
        $(".output").text(response);
        document.querySelector("#loader").style.display = "none";
      },
    });
  }
}
//font size feature
function changeEditorFontSize() {
  const editor = ace.edit("editor");
  const fontSize = parseInt(fontSizeInput.value);

  if (fontSize >= 13 && fontSize <= 30) {
    editor.setFontSize(fontSize + "px");
  } else {
    alert("Font size must be between 10 and 30.");
  }
}
//clear test on the editor feature
function clearCompiler() {
  editor = ace.edit("editor");
  editor.setValue("");
}
function clearOutput() {
  const output = document.querySelector(".output");
  output.innerHTML = "";
}
