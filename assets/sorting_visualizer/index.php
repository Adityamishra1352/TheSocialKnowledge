<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Sorting Visualizer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <header>
        <h2 style="margin-left: 15px;">The Social Knowledge:Sorting Visualizer</h2>
        <h3 id="speed">Speed
            <input id="speed_input" type="range" min="20" max="300" stepDown=10 value=60>
        </h3>
        <button onclick="window.location.href=(`../../index.php`)">Home</button>
        <button id="contactUs">Contact Us</button>
    </header>
    <div class="buttons">
      <button class="randomize_array" id="randomize_array">
        Randomize Array
      </button>
      <button class="sort_btn" id="sort_btn">BubbleSort</button>
      <button id="insertionsort">Insertion Sort</button>
      <button id="merge_sort">Merge Sort</button>
      <button id="selection_sort">Selection Sort</button>
      <button id="quick_sort">Quick Sort</button>
    </div>
    <div class="content_page">
        
      <div class="container">
        <div class="bars_container" id="bars_container"></div>
      </div>
    </div>
    
    <div class="description_container">
    <div class="bubblesort">
      <div class="introduction">
        <span
          ><b>Bubble sort</b> is a sorting algorithm that compares two adjacent
          elements and swaps them until they are in the intended order.</span
        >
        <br /><br />
        <span
          >Bubble sort is used if
          <ul>
            <li>complexity does not matter</li>
            <li>short and simple code is preferred</li>
          </ul></span
        >
      </div>
      <div class="complexity">
        <table>
          <tr>
            <th colspan="2">Time Complexity</th>
          </tr>
          <tr>
            <td>Best</td>
            <td>O(n))</td>
          </tr>
          <tr>
            <td>Worst</td>
            <td>O(n<sup>2</sup>)</td>
          </tr>
          <tr>
            <td>Average</td>
            <td>O(n<sup>2</sup>)</td>
          </tr>
          <tr>
            <th>Space Complexity</th>
            <td>O(1)</td>
          </tr>
          <tr>
            <th>Stability</th>
            <td>Yes</td>
          </tr>
        </table>
      </div>

      <div class="algorithm">
        <h3>Bubble Sort Algorithm:</h3>
        <br />
        <span>
          bubbleSort(array)<br />
          for i <- 1 to indexOfLastUnsortedElement-1 <br />
          if leftElement > rightElement<br />
          swap leftElement and rightElement<br />
          end bubbleSort<br />
        </span>
      </div>
    </div>
    <div class="insertion_box">
        <div class="introduction">
            <span>
                <b>Insertion sort</b> is a sorting algorithm that places an unsorted element at its suitable place in each iteration.
            </span>
            <span>The insertion sort is used when: <ul>
                <li>the array is has a small number of elements</li>
                <li>there are only a few elements left to be sorted</li>
                </ul></span>
        </div>
        <div class="complexity">
            <table>
                <tr>
                  <th colspan="2">Time Complexity</th>
                </tr>
                <tr>
                  <td>Best</td>
                  <td>O(n))</td>
                </tr>
                <tr>
                  <td>Worst</td>
                  <td>O(n<sup>2</sup>)</td>
                </tr>
                <tr>
                  <td>Average</td>
                  <td>O(n<sup>2</sup>)</td>
                </tr>
                <tr>
                  <th>Space Complexity</th>
                  <td>O(1)</td>
                </tr>
                <tr>
                  <th>Stability</th>
                  <td>Yes</td>
                </tr>
              </table>
        </div>
        <div class="algorithm">
            <h3>Insertion Sort Algorithm:</h3>
            <br>
            <span>insertionSort(array)<br>
                mark first element as sorted<br>
                for each unsorted element X<br>
                  'extract' the element X<br>
                  for j <- lastSortedIndex down to 0<br>
                    if current element j > X<br>
                      move sorted element to the right by 1<br>
                  break loop and insert X here<br>
              end insertionSort<br></span>
        </div>
    </div>
    <div id="merge_SORT" class="merge_SORT">
      <div class="introduction">
        <span><b>Merge Sort</b> is one of the most popular sorting algorithms that is based on the principle of Divide and Conquer Algorithm</span>
        <br /><br />
        <span>Merge Sort Applications: <ul>
          <li>Inversion count problem</li>
          <li>External sorting</li>
          <li>E-commerce applications</li></ul></span>
      </div>
      <div class="complexity">
        <table>
          <tr>
            <th colspan="2">Time Complexity</th>
          </tr>
          <tr>
            <td>Best</td>
            <td>O(n*logn)</td>
          </tr>
          <tr>
            <td>Worst</td>
            <td>O(n*log n)</td>
          </tr>
          <tr>
            <td>Average</td>
            <td>O(n*log n)</td>
          </tr>
          <tr>
            <th>Space Complexity</th>
            <td>O(n)</td>
          </tr>
          <tr>
            <th>Stability</th>
            <td>Yes</td>
          </tr>
        </table>
      </div>

      <div class="algorithm">
        <h3>Merge Sort Algorithm:</h3>
        <br />
        <span>
          step 1: start <br>

step 2: declare array and left, right, mid variable <br>

step 3: perform merge function. <br>
    if left > right <br>
        return <br>
    mid= (left+right)/2 <br>
    mergesort(array, left, mid) <br>
    mergesort(array, mid+1, right) <br>
    merge(array, left, mid, right) <br>

step 4: Stop <br>
        </span>
      </div>
    </div>
    <div id="selection_SORT" class="selection_SORT">
      <div class="introduction">
        <span><b>Selection Sort</b> is a sorting algorithm that selects the smallest element from an unsorted list in each iteration and places that element at the beginning of the unsorted list.</span>
        <br /><br />
        <span>Selection Sort Applications: <ul>
<li>a small list is to be sorted</li>
<li>cost of swapping does not matter</li>
<li>checking of all the elements is compulsory</li>
<li>cost of writing to a memory matters like in flash memory (number of writes/swaps is O(n) as compared to O(n<sup>2</sup>) of bubble sort)</li>
</ul></span>
      </div>
      <div class="complexity">
        <table>
          <tr>
            <th colspan="2">Time Complexity</th>
          </tr>
          <tr>
            <td>Best</td>
            <td>O(n<sup>2</sup>)</td>
          </tr>
          <tr>
            <td>Worst</td>
            <td>O(n<sup>2</sup>)</td>
          </tr>
          <tr>
            <td>Average</td>
            <td>O(n<sup>2</sup>)</td>
          </tr>
          <tr>
            <th>Space Complexity</th>
            <td>O(1)</td>
          </tr>
          <tr>
            <th>Stability</th>
            <td>No</td>
          </tr>
        </table>
      </div>

      <div class="algorithm">
        <h3>Selection Sort Algorithm:</h3>
        <br />
        <span>
          selectionSort(array, size)<br>
  repeat (size - 1) times<br>
  set the first unsorted element as the minimum<br>
  for each of the unsorted elements<br>
    if element < currentMinimum<br>
      set element as new minimum<br>
  swap minimum with first unsorted position<br>
end selectionSort<br>
        </span>
      </div>
    </div>
    <div id="quick_SORT" class="quick_SORT">
      <div class="introduction">
        <span><b>Quick Sort</b> is a divide-and-conquer algorithm. It works by selecting a 'pivot' element from the array and partitioning the other elements into two sub-arrays, according to whether they are less than or greater than the pivot. The sub-arrays are then sorted recursively. This can be done in-place, requiring small additional amounts of memory to perform the sorting.</span>
        <br /><br />
        <span>Quicksort algorithm is used when:<ul>
<li>the programming language is good for recursion</li>
<li>time complexity matters</li>
<li>space complexity matters</li>
</ul></span>
      </div>
      <div class="complexity">
        <table>
          <tr>
            <th colspan="2">Time Complexity</th>
          </tr>
          <tr>
            <td>Best</td>
            <td>O(n*log n)</td>
          </tr>
          <tr>
            <td>Worst</td>
            <td>O(n<sup>2</sup>)</td>
          </tr>
          <tr>
            <td>Average</td>
            <td>O(n*log n)</td>
          </tr>
          <tr>
            <th>Space Complexity</th>
            <td>O(log n)</td>
          </tr>
          <tr>
            <th>Stability</th>
            <td>No</td>
          </tr>
        </table>
      </div>

      <div class="algorithm">
        <h3>Quick Sort Algorithm:</h3>
        <br />
        <span>
          quickSort(array, leftmostIndex, rightmostIndex)<br>
  if (leftmostIndex < rightmostIndex)<br>
    pivotIndex <- partition(array,leftmostIndex, rightmostIndex)<br>
    quickSort(array, leftmostIndex, pivotIndex - 1)<br>
    quickSort(array, pivotIndex, rightmostIndex)<br>
    <br>
partition(array, leftmostIndex, rightmostIndex)<br>
  set rightmostIndex as pivotIndex<br>
  storeIndex <- leftmostIndex - 1<br>
  for i <- leftmostIndex + 1 to rightmostIndex<br>
  if element[i] < pivotElement<br>
    swap element[i] and element[storeIndex]<br>
    storeIndex++<br>
  swap pivotElement and element[storeIndex+1]<br>
return storeIndex + 1<br><br>
        </span>
      </div>
    </div>
   </div>
   <div id="myModal" class="modal">
    <div class="modal_content">
      <div class="modal_header">
        <span class="close">&times;</span>
      <h2>Contact Us </h2>
      </div>
      <div class="modal_body">
        <div class="adityamishra">
          <img src="adityamishra.jpg" alt="Aditya Mishra">
          <br>
          <label>Email:
            <a href="mailto:201b016@juetguna.in">201b016@juetguna.in</a><br>
          </label>
          <label>Phone Number:
            <a href="tel:+919555629601">+919555629601</a>
          </label><br>
        </div>
      </div>
    </div>
   </div>
    <script src="index.js"></script>
    <script src="bubbleSort.js"></script>
    <script src="insertion.js"></script>
    <script src="merge_box.js"></script>
    <script src="quick_box.js"></script>
    <script src="selection_box.js"></script>
  </body>
</html>
