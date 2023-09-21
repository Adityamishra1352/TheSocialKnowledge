let randomize_Array=document.getElementById("randomize_array");
let sort_btn=document.getElementById("sort_btn");
let bars_container=document.getElementById("bars_container")
let minRange=1;
let maxRange=20;
let numofBars=20;
let unsorted_array=new Array(numofBars);
let bubble_box=document.querySelector(".bubblesort");
let descriptionContainer=document.querySelector(".description_container");
let insertion_box=document.querySelector(".insertion_box");

function disableSortingBtn(){
    document.querySelector(".sort_btn").disabled=true;
    document.querySelector("#insertionsort").disabled=true;
    document.querySelector("#merge_sort").disabled=true;
    document.querySelector("#selection_sort").disabled=true;
    document.querySelector("#quick_sort").disabled=true;
}
function enableSortingBtn(){
    document.querySelector(".sort_btn").disabled=false;
    document.querySelector("#insertionsort").disabled=false;
    document.querySelector("#merge_sort").disabled=false;
    document.querySelector("#selection_sort").disabled=false;
    document.querySelector("#quick_sort").disabled=false;
}
function disableRandomizeArray(){
    document.querySelector(".randomize_array").disabled=true;
}
function enableRandomArray(){
    document.querySelector(".randomize_array").disabled=false;
}
// function disableSpeedSlider(){
//     document.querySelector(".speed_input").diabled=true;
// }
// function enableSpeedSlider(){
//     document.querySelector(".speed_input").disabled=false;
// }
function randomNumber(min,max){
    return Math.floor(Math.random()*(max-min+1)+min);
}
function createRandomArray(){
    for(let i=0;i<numofBars;i++){
        unsorted_array[i]=randomNumber(1,20);
    }
    
}
let delay=200;
let delay_element=document.querySelector("#speed_input");
delay_element.addEventListener('input',function(){
    delay=320-parseInt(delay_element.value);
})
function sleep(delay){
    return new Promise((resolve)=>setTimeout(resolve,delay));
}
document.addEventListener("DOCContentLoaded",function(){
    createRandomArray();
    renderBars(unsorted_array);
});
async function renderBars(array){
    for(let i=0;i<array.length;i++){
    let bar=document.createElement("div");
    bar.classList.add("bars");
    bar.style.height=array[i]*20+"px";
    bar.style.backgroundColor="#e7cac2";
    bars_container.appendChild(bar);
    console.log(array);
    await sleep(delay);
    }
}
randomize_Array.addEventListener("click",function(){
    disableSortingBtn();
    createRandomArray();
    bars_container.innerHTML="";
    renderBars(unsorted_array);
    bubble_box.classList.remove("activateBubble");
    insertion_box.classList.remove("activateInsertion");
    merge_box.classList.remove("activateMerge");
    selection_box.classList.remove("activateSelection");
    quick_box.classList.remove("activateQuick");
    enableSortingBtn();
});
Modal();

function Modal() {
    var modal = document.getElementById("myModal");
    var contact_us = document.getElementById("contactUs");
    var span = document.getElementsByClassName("close")[0];

    contact_us.onclick = () => {
        modal.style.display = "block";
    };
    span.onclick = function () {
        modal.style.display = "none";
    };
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
}
