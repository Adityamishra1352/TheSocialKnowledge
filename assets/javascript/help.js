const help_btn=document.querySelector(".helpButton");
const chat_btn=document.querySelector(".chat_btn");
const cross_btn=document.querySelector(".cross_btn");
cross_btn.disabled=true;
const help_container=document.querySelector(".help");
help_btn.onclick=()=>{
    help_container.style.display="block";
    // chat_btn.disabled=true;
    cross_btn.style.display="block";
    cross_btn.disabled=false;
}
cross_btn.onclick=()=>{
    help_container.style.display="none";
    chat_btn.disabled=false;
    cross_btn.style.display="none";
    cross_btn.disabled=true;
}