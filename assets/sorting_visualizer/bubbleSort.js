
async function bubbleSort() {
    let bars = document.getElementsByClassName("bars");
    for (let i = 0; i < bars.length - 1; i++) {
        for (let j = 0; j < bars.length - i - 1; j++) {
            if (parseInt(bars[j].style.height) > parseInt(bars[j + 1].style.height)) {
                // for (let k = 0; k < bars.length; k++) {
                //     if(k!==j && k!==j+1){
                //         bars[k].style.backgroundColor="#e7cac2";
                //     }
                // }
                let temp = bars[j].style.height;
                bars[j].style.height = bars[j + 1].style.height;
                bars[j + 1].style.height = temp;
                // bars[j].style.height=array[j]*20+"px";
                bars[j].style.backgroundColor = "lightgreen";
                // bars[j].innerText=array[j];
                // bars[j+1].style.height=array[j+1]*20+"px";
                bars[j + 1].style.backgroundColor = "lightgreen";
                // bars[j+1].innerText=array[j+1];
                await sleep(delay);
            }
        }
        bars[bars.length - 1 - i].style.background = "lightgreen";
        await sleep(delay);
    }
    // for(let i=0;i<array.length;i++){
    //     bars[i].style.background="#e7cac2";
    // }
    bars[0].style.background = "lightgreen";
}
sort_btn.addEventListener("click", async function () {
    // console.log(sortedArray);
    bubble_box.classList.add("activateBubble");
    insertion_box.classList.remove("activateInsertion");
    selection_box.classList.remove("activateSelection");
    merge_box.classList.remove("activateMerge");
    quick_box.classList.remove("activateQuick");
    disableRandomizeArray();
    disableSortingBtn();
    await bubbleSort(unsorted_array);
    enableRandomArray();
    enableSortingBtn();
});
