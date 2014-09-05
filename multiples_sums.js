var multiples = [];
var sum = 0;

// Check if the numbers between 1 and 999 are multiples of 3 or 5
for (var i = 0; i < 1000; i++) {
    if ((i % 3 == 0) || (i % 5 == 0)) {
        multiples.push(i);
    }
}

multiples.forEach(function (numbers, index, multiples) {
    // Add all of the elements of the multiples array.
    sum += numbers;
});

console.log(sum);
