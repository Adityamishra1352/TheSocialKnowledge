//quick sort

async function partition(bars, left, right) {
    let i = left - 1;
    bars[right].style.background = "red";
    for (let j = left; j <= right - 1; j++) {
        bars[j].style.background = "yellow";
        await sleep(delay);
        if (parseInt(bars[j].style.height) < parseInt(bars[right].style.height)) {
            i++;
            console.log(bars[i].style.height);
            let temp = bars[i].style.height;
            bars[i].style.height = bars[j].style.height;
            bars[j].style.height = temp;
            bars[i].style.height = "orange";
            if (i != j) {
                bars[j].style.background = "orange";
            }
            await sleep(delay);
        }
        else {
            bars[j].style.height = "blue";
        }
    }
    i++;
    await sleep(delay);
    let temp = bars[i].style.height;
    bars[i].style.height = bars[right].style.height;
    bars[right].style.height = temp;
    bars[right].style.background = "blue";
    bars[i].style.background = "lightgreen";
    await sleep(delay);
    for (let k = 0; k < bars.length; k++) {
        if (bars[k].style.background != "lightgreen") {
            bars[k].style.background = "green";
        }
    }
    return i;
}
async function quickSort(bars, left, right) {
    if (left < right) {
        let pivot_index = await partition(bars, left, right);
        await quickSort(bars, left, pivot_index - 1);
        await quickSort(bars, pivot_index + 1, right);
    }
    else {
        if (left >= 0 && right >= 0 && left < bars.length && right < bars.length) {
            bars[right].style.background = "lightgreen";
            bars[left].style.background = "lightgreen";
        }
    }
}
const quick_box = document.getElementById("quick_SORT");
const quickSort_btn = document.getElementById("quick_sort");
quickSort_btn.addEventListener("click", function () {
    quick_box.classList.add("activateQuick");
    selection_box.classList.remove("activateSelection");
    insertion_box.classList.remove("activateInsertion");
    bubble_box.classList.remove("activateBubble");
    merge_box.classList.remove("activateMerge");
});
quickSort_btn.addEventListener("click", async function () {
    console.log("quick sort");
    let bars = document.getElementsByClassName("bars");
    let left = 0;
    let right = bars.length - 1;
    disableSortingBtn();
    disableRandomizeArray();
    await quickSort(bars, left, right);
    enableSortingBtn();
    enableRandomArray();
});

