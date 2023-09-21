
async function insertion(array) {
    let bars = document.getElementsByClassName("bars");
    bars[0].style.backgroundColor = "#e7cac2";
    for (let i = 1; i < bars.length; i++) {
        let j = i - 1;
        let key = bars[i].style.height;
        bars[i].style.background = 'yellow';
        await sleep(delay);
        while (j >= 0 && parseInt(bars[j].style.height) > parseInt(key)) {
            bars[j].style.background = 'lightgreen';
            bars[j + 1].style.height = bars[j].style.height;
            // bars[j].style.height=array[j]*20+"px";
            // bars[j+1].style.height=array[j+1]*20+"px";
            j = j - 1;
            await sleep(delay);

            for (let k = i; k >= 0; k--) {
                bars[k].style.background = 'lightgreen';
            }
        }
        bars[j + 1].style.height = key;
        bars[i].style.background="green";
        // bars[j+1].style.height=array[j+1]*10+"px";
        // bars[i].style.background='red';
    }
    return array;
}
const insertionsort_btn = document.getElementById("insertionsort");
insertionsort_btn.addEventListener("click",async function () {
    insertion_box.classList.add("activateInsertion");
    bubble_box.classList.remove("activateBubble");
    selection_box.classList.remove("activateSelection");
    merge_box.classList.remove("activateMerge");
    quick_box.classList.remove("activateQuick");
    disableRandomizeArray();
    disableSortingBtn();
    await insertion(unsorted_array);
    enableRandomArray();
    enableSortingBtn();
    // console.log("sorted array" + sortedArray);
    
});
