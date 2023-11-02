let editor;
window.onload=function(){
    editor=ace.edit("editor");
    editor.setTheme("ace/theme/github");
    editor.session.setMode("ace/mode/c_cpp");
}
function changeLanguage(){
    let language=$("#languages").val();
    if(language=='c'||language=='cpp'){
        editor.session.setMode("ace/mode/c_cpp");
        document.querySelector(".codeEditor").style.display="flex";
        document.querySelector(".htmlcssjs_container").style.display="none";
    }
    else if(language =='php'){
        editor.session.setMode("ace/mode/php");
        document.querySelector(".codeEditor").style.display="flex";
        document.querySelector(".htmlcssjs_container").style.display="none";
    }
    else if(language =='nodejs'){
        editor.session.setMode("ace/mode/javascript");
        document.querySelector(".codeEditor").style.display="flex";
        document.querySelector(".htmlcssjs_container").style.display="none";
    }
    else if(language =='python'){
        editor.session.setMode("ace/mode/python");
        document.querySelector(".codeEditor").style.display="flex";
        document.querySelector(".htmlcssjs_container").style.display="none";
    }
    else if(language=='htmlcssjs'){
        document.querySelector(".codeEditor").style.display="none";
        document.querySelector(".htmlcssjs_container").style.display="block";
    }
}
function compileHTMLCode() {
    const htmlCode = document.getElementById('htmlInput').value;
    const cssCode = document.getElementById('cssInput').value;
    const jsCode = document.getElementById('jsInput').value;
    const output = document.getElementById('outputHTML');
    const iframe = document.createElement('iframe');
    iframe.style.display = 'none';
    document.body.appendChild(iframe);
    const doc = iframe.contentDocument;
    doc.open();
    doc.write(`<style>${cssCode}</style>${htmlCode}`);
    doc.close();
    const script = doc.createElement('script');
    script.text = jsCode;
    doc.body.appendChild(script);
    output.innerHTML = doc.documentElement.outerHTML;
    document.body.removeChild(iframe);
}



function executeCode(){
    $.ajax({
        url:"../test/compiler.php",
        method: "POST",
        data:{
            language:$("#languages").val(),
            code:editor.getSession().getValue()
        },
        success:function(response){
            $(".output").text(response)
        }
    })
}
function changeEditorFontSize() {
    const editor = ace.edit('editor');
    const fontSize = parseInt(fontSizeInput.value);

    if (fontSize >= 10 && fontSize <= 30) {
        editor.setFontSize(fontSize + 'px');
    } else {
        alert('Font size must be between 10 and 30.');
    }
}
function clearCompiler(){
    editor=ace.edit('editor');
    editor.setValue('');
}
function clearOutput(){
    const output=document.querySelector(".output");
    output.innerHTML='';
}