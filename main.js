const add = document.querySelector('article:first-child')
// console.log(add)
add.addEventListener('click', () => {
  // console.log(add)
  window.location.href = 'doc.php'
})
// const del = document.querySelector('article h1 button')
const header = document.querySelector('header')
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function (e) {
  console.log(xhr.readyState);
  if (xhr.readyState === 4) {
    console.log(xhr.responseText);// modify or populate html elements based on response.
    //DOM Manipulation
    const res = JSON.parse(xhr.responseText)
    res.forEach((x) => {
      // console.log(x.title)
      const art = document.createElement('article')
      art.innerHTML = `<p>${x.content}</p>
        <h1>
          <span>${x.title ? x.title : 'untitled'}</span>
          <button onclick="delArt(${x.docId})">Delete</button>
        </h1>`
      art.addEventListener('click', function () { edit(x.docId) })
      header.appendChild(art)
    })
  }
};

xhr.open("GET", "select.php", true); //true means it is asynchronous // Send variables through the url
xhr.send();
function edit(id) {
  console.log(id)
  window.location.href = `doc.php?docId=${id}`

}
function delArt(id) {
  console.log(event)
  event.stopPropagation()
  let confirm = window.confirm('Are you sure?')
  if (confirm) {
    // console.log(1)
    window.location.replace(`delete.php?docId=${id}`)

  } else {
    console.log(2)
  }
}