//selection sort

async function selectionSort() {
    let bars = document.getElementsByClassName("bars");
    for (let i = 0; i < bars.length; i++) {
        console.log(bars[i].style.height);
    }
    for (let i = 0; i < bars.length; i++) {
        console.log("in selection");
        let min_index = i;
        bars[i].style.background = "blue";
        for (let j = i + 1; j < bars.length; j++) {
            bars[j].style.background = "red";
            await sleep(delay);
            if (parseInt(bars[j].style.height) < parseInt(bars[min_index].style.height)) {
                if (min_index !== i) {
                    bars[min_index].style.background = "lightgreen";
                }
                min_index = j;
            }
            else {
                bars[j].style.background = "lightgreen";
            }
        }
        await sleep(delay);
        let temp = bars[min_index].style.height;
        bars[min_index].style.height = bars[i].style.height;
        bars[i].style.height = temp;
        bars[min_index].style.background = "lightgreen";
        bars[i].style.bacground = "green";
    }
}
const selection_box = document.getElementById("selection_SORT");
const selectionSortbtn = document.getElementById("selection_sort");
selectionSortbtn.addEventListener("click", function () {
    selection_box.classList.add("activateSelection");
    insertion_box.classList.remove("activateInsertion");
    bubble_box.classList.remove("activateBubble");
    merge_box.classList.remove("activateMerge");
    quick_box.classList.remove("activateQuick");
});
selectionSortbtn.addEventListener("click", async function () {
    disableSortingBtn();
    disableRandomizeArray();
    await selectionSort();
    enableSortingBtn();
    enableRandomArray();
});

