let arr = [1, 2, 3, 4, 5];
let subArr = [];

// console.log(arr);
for (let i = 0; i < arr.length; i++) {
    getSubset(arr, i);
}
function getSubset(arr, i) {

    for (let j = 0; j < arr.length; j++) {
        subArr.push(arr[j]+","+arr[i]);
    }
    return;
}
console.log(subArr);
