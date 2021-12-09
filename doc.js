const saveBtn = document.querySelector('header div button')
const title = document.querySelector('header input')
const content = document.querySelector('textarea')
const saved = document.querySelector('header div>span')
function getQueryVariable(variable) {
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split("=");
    if (pair[0] == variable) { return pair[1]; }
  }
  return (false);
}
console.log(getQueryVariable('docId'))
let docId = getQueryVariable('docId')
saveBtn.addEventListener('click', submit)
title.addEventListener('input', debounce(submit, 400))
content.addEventListener('input', debounce(submit, 400))
function submit() {
  console.log(title.value)
  console.log(content.value)
  docId ? send(title.value, content.value, docId) : send(title.value, content.value)
}
function send(title, content, id = undefined) {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function (e) {
    console.log(xhr.readyState);
    if (xhr.readyState === 4) {
      console.log(xhr.responseText);// modify or populate html elements based on response.
      let response = JSON.parse(xhr.responseText);
      //DOM Manipulation
      if (response.success) {
        console.log(response.success);
        if (!docId) {

          docId = response.docId;
        }
        document.title = title ? title : 'untitled'
        saved.style.opacity = '1'
        // let hideSaved
        // if (hideSaved) {
        //   clearTimeout(hideSaved)
        // }
        setTimeout(() => {
          saved.style.opacity = '0'
        }, 2000)
        // test sheridan server
        history.replaceState({ docId }, '', `doc.php?docId=${docId}`)
        if (!document.querySelector('section button')) {
          const section = document.querySelector('section')
          // section.innerHTML += '<button>Delete</button>'
          const del = document.createElement('button')
          del.innerHTML = 'Delete'
          del.addEventListener('click', delHandler)
          section.appendChild(del)
        }
      } else {
        alert('error, please try again')
      }
    }
  };
  xhr.open("POST", "process.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // console.log(JSON.stringify(data))
  id ? xhr.send(`title=${title}&content=${content}&docId=${id}`) : xhr.send(`title=${title}&content=${content}`);

}
function debounce(fn, delay) {
  let timer = null //借助闭包
  return function () {
    if (timer) {
      clearTimeout(timer)
    }
    timer = setTimeout(fn, delay) // 简化写法
  }
}
function delHandler() {
  console.log(1)
  let confirm = window.confirm('Are you sure?')
  if (confirm) {
    // console.log(1)
    window.location.replace(`delete.php?docId=${docId}`)

  } else {
    console.log(2)
  }
}
