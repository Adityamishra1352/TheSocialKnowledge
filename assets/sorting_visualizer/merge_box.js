//Merge Sort

async function merge(bars, low, mid, high) {
    console.log("in merge");
    const num1 = mid - low + 1;
    const num2 = high - mid;
    let left = new Array(num1);
    let right = new Array(num2);
    for (let i = 0; i < num1; i++) {
        await sleep(delay);
        bars[low + i].style.background = "green";
        left[i] = bars[low + i].style.height;
    }
    for (let i = 0; i < num2; i++) {
        await sleep(delay);
        bars[mid + 1 + i].style.background = "yellow";
        right[i] = bars[mid + 1 + i].style.height;
    }
    await sleep(delay);
    let i = 0, j = 0, k = low;
    while (i < num1 && j < num2) {
        await sleep(delay);
        if (parseInt(left[i]) <= parseInt(right[j])) {
            if ((num1 + num2) === bars.length) {
                bars[k].style.background = "orange";
            }
            else {
                bars[k].style.background = "lightgreen";
            }
            bars[k].style.height = left[i];
            i++;
            k++;
        }
        else {
            if ((num1 + num2) === bars.length) {
                bars[k].style.background = "lightgreen";
            }
            else {
                bars[k].style.background = "orange";
            }
            bars[k].style.height = right[j];
            j++;
            k++;
        }
    }
    while (i < num1) {
        await sleep(delay);
        if ((num1 + num2) === bars.length) {
            bars[k].style.background = "lightgreen";
        }
        else {
            bars[k].style.background = "orange";
        }
        bars[k].style.height = left[i];
        i++;
        k++;
    }
    while (j < num2) {
        await sleep(delay);
        if ((num1 + num2) === bars.length) {
            bars[k].style.background = 'lightgreen';
        }
        else {
            bars[k].style.background = 'orange';
        }
        bars[k].style.height = right[j];
        j++;
        k++;
    }
}

async function mergeSort(bars, l, r) {
    if (l >= r) {
        return;
    }
    const mid = l + Math.floor((r - l) / 2);
    await mergeSort(bars, l, mid);
    // await sleep(delay);
    await mergeSort(bars, mid + 1, r);
    await merge(bars, l, mid, r);
    // await sleep(1000);
    //     for(let i=0;i<bars.length;i++){
    //         bars[i].style.background="lightgreen";
    //     }
}
let merge_box = document.getElementById("merge_SORT");
const mergeSortbtn = document.getElementById("merge_sort");
mergeSortbtn.addEventListener("click", function () {
    insertion_box.classList.remove("activateInsertion");
    selection_box.classList.remove("activateSelection");
    bubble_box.classList.remove("activateBubble");
    merge_box.classList.add("activateMerge");
    quick_box.classList.remove("activateQuick");
});
mergeSortbtn.addEventListener('click', async function () {
    let bars = document.getElementsByClassName("bars");
    let left = 0;
    let right = parseInt(bars.length) - 1;
    disableRandomizeArray();
    disableSortingBtn();
    await mergeSort(bars, left, right);
    enableRandomArray();
    enableSortingBtn();
});

