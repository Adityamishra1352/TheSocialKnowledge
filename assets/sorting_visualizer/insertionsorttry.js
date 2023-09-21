function insertionSort(array,n){
    for(let i=1;i<n;i++){
        key=array[i];
        let j=i-1;
        while(j>=0 && array[j]>key){
            array[j+1]=array[j];
            j=j-1;
        }
        array[j+1]=key;
    }
}
function peintArray(array,n){
    for(let i=0;i<n;i++){
        console.log(array[i]+" ,");
    }
}
let array=[12,11,13,4,3,2,1,1,17,7];
let n=array.length;
insertionSort(array,n);
peintArray(array,n);