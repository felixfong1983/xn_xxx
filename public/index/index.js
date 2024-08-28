$(function() {
//====================================
//==========================================
  var videoBox = $(".video-content");
  // localStorage.setItem("crtItem",JSON.stringify($(this).data('item')))
  //    videoBox.on("click", ".title", function() {
  //  window.open("/pages/detail/detail.html")
    
  // });

  // 绑定事件：鼠标进入时播放视频
  videoBox.on("mouseenter", ".video-preview", function() {
      this.play();
  });
  // 绑定事件：鼠标离开时暂停视频并重置时间
  videoBox.on("mouseleave", ".video-preview", function() {
      this.pause();
      this.currentTime = 0;
  });

//========================================
var icon = $(".icon")
var input = $(".input")
var search = $("#search")
const lastSearch = localStorage.getItem("lastSearch")
input.keyup(function(){
  if($(this).val().length>0){
    icon.show()
  }else{
    icon.hide()
  }
})

// search.click(function(){
//     if(!input.val()){
//       alert("不可为空")
//       return
//     }
//     localStorage.setItem("key",input.val())
//     window.open("/pages/search/search.html")
//     console.log("aaa");
// })
icon.click(function(){
  input[0].value = "" 
  icon.hide()
  input[0].focus()
})
input.blur(function(){
  localStorage.setItem("lastSearch",input.val())
})
if(lastSearch){
  input[0].placeholder = lastSearch
}
var propBox = $(".propt")
input.focus(function(){
  propBox.show()
})
input.blur(function(){
  setTimeout(()=>{
    propBox.hide()

  },100)
})
// const searchHistory=[
//   {id:1,text:"测试1"},
//   {id:1,text:"测试2"},
//   {id:1,text:"测试3"},
//   {id:1,text:"测试4"},
//   {id:1,text:"测试5"},
//   {id:1,text:"测试6"},
//   {id:1,text:"测试7"},
//   {id:1,text:"测试8"},
// ]
var prop = $(".propt-box")
// $.each(searchHistory,(index,item)=>{
//   var list = `<div class="propt-item">${item.text}</div>`
//   prop.append(list)
// })

prop.on("click", ".propt-item", function() {
  var selectedText = $(this).text();
  input.val(selectedText)
  input[0].focus()
  icon.show()
  propBox.hide()
});
//=============================


// const navList = [
//   {id:1,text:"主页"},
//   {id:2,text:"标签导航"}

// ]

var navBox = $(".lable-box")
// $.each(navList,(index,item)=>{
//   var listItem = `<div class="lable" data-item="${index}">${item.text}</div>`
//   navBox.append(listItem)
// })

var lableBox =$(".popver-box")
// const lableList=[
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
//   {id:1,text:"测试"},
// ]
lableBox.hide()

// $.each(lableList,(index,item)=>{
//   var listItem = `<div class="popver-item">${item.text}</div>`
//   lableBox.append(listItem)
// })

var popverTimeId = ""
navBox.on("mouseenter",".lable",function(){
  console.log($(this).data('item'))
  if($(this).data('item')===1){
    clearTimeout(popverTimeId)
    lableBox.show()
  }
})
navBox.on("mouseleave",".lable",function(){
  popverTimeId = setTimeout(()=>{
      lableBox.hide()
    },100)  
})
lableBox.mousemove(function(){
  clearTimeout(popverTimeId)
      lableBox.show()
})
lableBox.mouseleave(function(){
  popverTimeId = setTimeout(()=>{
    lableBox.hide()
  },100)  
})

//=====================2========================

});
