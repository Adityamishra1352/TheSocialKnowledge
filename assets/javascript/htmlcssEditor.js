var htmlEditor, cssEditor, jsEditor;
let startingSyntax = "";
let cssstartingSyntax = "";
let jsSyntax = "";
window.onload = function () {
  htmlEditor = ace.edit("html-editor");
  htmlEditor.setTheme("ace/theme/github");
  startingSyntax =
    '<!DOCTYPE html>\n<html lang="en">\n<head>\n    <meta charset="UTF-8">\n    <meta name="viewport" content="width=device-width, initial-scale=1.0">\n    <title>My HTML Page</title>\n</head>\n<body>\n    <h1>Hello, World!</h1>\n</body>\n</html>';
  htmlEditor.setValue(startingSyntax);
  htmlEditor.getSession().setMode("ace/mode/html");
  htmlEditor.on("change", runCode);

  cssEditor = ace.edit("css-editor");
  cssEditor.setTheme("ace/theme/github");
  cssstartingSyntax =
    "/* Add your CSS styles here */\nbody {\n    font-family: Arial, sans-serif;\n    background-color: #f0f0f0;\n    color: #333;\n}";
  cssEditor.setValue(cssstartingSyntax);
  cssEditor.getSession().setMode("ace/mode/css");
  cssEditor.on("change", runCode);

  jsEditor = ace.edit("js-editor");
  jsEditor.setTheme("ace/theme/github");
  jsSyntax = "//Your JS Code here";
  jsEditor.getSession().setMode("ace/mode/javascript");
  jsEditor.setValue(jsSyntax);
  jsEditor.on("change", runCode);
  htmlEditor.clearSelection();
  cssEditor.clearSelection();
  jsEditor.clearSelection();
  htmlEditor.setOptions({
    enableBasicAutocompletion: true,
    enableSnippets: true,
    enableLiveAutocompletion: true,
  });
  cssEditor.setOptions({
    enableBasicAutocompletion: true,
    enableSnippets: true,
    enableLiveAutocompletion: true,
  });
  jsEditor.setOptions({
    enableBasicAutocompletion: true,
    enableSnippets: true,
    enableLiveAutocompletion: true,
  });
  ace.require("ace/ext/language_tools").addCompleter({
    getCompletions: function (htmlEditor, session, pos, prefix, callback) {
        var htmlTags = [
            "a", "abbr", "address", "area", "article", "aside", "audio", "b", "base", "bdi", "bdo", "blockquote",
            "body", "br", "button", "canvas", "caption", "cite", "code", "col", "colgroup", "data", "datalist",
            "dd", "del", "details", "dfn", "dialog", "div", "dl", "dt", "em", "embed", "fieldset", "figcaption",
            "figure", "footer", "form", "h1", "h2", "h3", "h4", "h5", "h6", "head", "header", "hgroup", "hr",
            "html", "i", "iframe", "img", "input", "ins", "kbd", "label", "legend", "li", "link", "main", "map",
            "mark", "meta", "meter", "nav", "noscript", "object", "ol", "optgroup", "option", "output", "p",
            "param", "picture", "pre", "progress", "q", "rp", "rt", "ruby", "s", "samp", "script", "section",
            "select", "small", "source", "span", "strong", "style", "sub", "summary", "sup", "svg", "table",
            "tbody", "td", "template", "textarea", "tfoot", "th", "thead", "time", "title", "tr", "track",
            "u", "ul", "var", "video", "wbr"
        ];

        var completions = htmlTags.map(function (tag) {
            return { value: "<" + tag + "></" + tag + ">", meta: "HTML" };
        });

        callback(null, completions);
    },
});
runCode();
};

function runCode() {
  var htmlCode = htmlEditor.getValue();
  var cssCode = `<style>${cssEditor.getValue()}</style>`;
  var jsCode = `<script>${jsEditor.getValue()}</script>`;
  var outputFrame = document.getElementById("output");
  var outputDocument = outputFrame.contentDocument;
  outputDocument.open();
  outputDocument.write(htmlCode + cssCode);
  outputDocument.write(jsCode);
  outputDocument.close();
}
function changeEditorFontSize() {
  const fontSize = parseInt(fontSizeInput.value);

  if (fontSize >= 13 && fontSize <= 30) {
    htmlEditor.setFontSize(fontSize + "px");
    cssEditor.setFontSize(fontSize + "px");
    jsEditor.setFontSize(fontSize + "px");
  } else {
    alert("Font size must be between 13 and 30.");
  }
}
