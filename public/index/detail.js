$(function() {
  var crtItem = JSON.parse(localStorage.getItem("crtItem"))
  
    var crtItem = {
    clear:"1080P",
    count:100,
    id: 3,
    point: 200,
    tap:100,
    time: 120,
    title: "测试",
    url: "../../assets/3.mp4"}
  //=================================
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
search.click(function(){
  if(!input.val()){
    alert("不可为空")
    return
  }
  localStorage.setItem("key",input.val())
  window.open("/pages/search/search.html")
  console.log("aaa");
})
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
const searchHistory=[
  {id:1,text:"测试1"},
  {id:1,text:"测试2"},
  {id:1,text:"测试3"},
  {id:1,text:"测试4"},
  {id:1,text:"测试5"},
  {id:1,text:"测试6"},
  {id:1,text:"测试7"},
  {id:1,text:"测试8"},
]
var prop = $(".propt-box")
$.each(searchHistory,(index,item)=>{
  var list = `<div class="propt-item">${item.text}</div>`
  prop.append(list)
})

prop.on("click", ".propt-item", function() {
  var selectedText = $(this).text();
  input.val(selectedText)
  input[0].focus()
  icon.show()
  propBox.hide()
});
  //==============================

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
  

//===========================================================  
  const recommandList = [
    { id: 1, title: "测试测试测试测试测试测试测试测试测试测试", count: 100, point: 200,tap:100, time: 120, clear: "1080P", url: "../../assets/1.mp4" },
    { id: 2, title: "测试", count: 100, point: 200,tap:100, time: 120, clear: "1080P", url: "../../assets/2.mp4" },
    { id: 3, title: "测试", count: 100, point: 200, tap:100,time: 120, clear: "1080P", url: "../../assets/3.mp4" },
    { id: 4, title: "测试", count: 100, point: 200, tap:100,time: 120, clear: "1080P", url: "../../assets/1.mp4" },
    { id: 5, title: "测试", count: 100, point: 200, tap:100,time: 120, clear: "1080P", url: "../../assets/2.mp4" },
    { id: 6, title: "测试", count: 100, point: 200, tap:100,time: 120, clear: "1080P", url: "../../assets/3.mp4" },
    { id: 7, title: "测试", count: 100, point: 200, tap:100,time: 120, clear: "1080P", url: "../../assets/1.mp4" },
    { id: 8, title: "测试", count: 100, point: 200, tap:100,time: 120, clear: "1080P", url: "../../assets/2.mp4" },
    { id: 9, title: "测试", count: 100, point: 200, tap:100,time: 120, clear: "1080P", url: "../../assets/3.mp4" },
    { id: 10, title: "测试", count: 100, point: 200, tap:100,time: 120, clear: "1080P", url: "../../assets/1.mp4" },
    { id: 11, title: "测试", count: 100, point: 200, tap:100,time: 120, clear: "1080P", url: "../../assets/2.mp4" },
    { id: 12, title: "测试", count: 100, point: 200, tap:100,time: 120, clear: "1080P", url: "../../assets/3.mp4" },
  ];
  //============================================================
  const video2 = $(".video2-preview")
  const preview = $("#preview")
  const previewContainer = $(".preview-container")
  const progressBar = $('.progress-bar');
  const progressContainer = $('.progress-container');
  // 更新进度条
  video2[0].addEventListener('timeupdate', function() {
    const percentage = (video2[0].currentTime / video2[0].duration) * 100;
    progressBar.css("width",percentage + '%')
  });
  // 点击进度条跳转视频
  // progressContainer.click(function(event) {
  //   const progressContainer = $(this);
  //   const offset = progressContainer.offset();
  //   const width = progressContainer.width();
  //   const clickX = event.pageX - offset.left;
  //   const newTime = (clickX / width) * video2[0].duration;
  //   video2[0].currentTime = newTime;
  // });
  // progressContainer[0].addEventListener('mousemove', function(event) {
  //   const duration = video2[0].duration
  //   const rect = video2[0].getBoundingClientRect();
  //   const x = event.clientX - rect.left;
  //   const percentage = x / rect.width;
  //   const previewTime = duration * percentage;
  //   const previewImageUrl = getPreviewImageUrl(previewTime);
  //   console.log(percentage);
  //   preview.attr("src",previewImageUrl)
  //   preview.css("display","block")
  //   previewContainer.css("left",x - preview[0].width / 2)
    
  // })
  // progressContainer[0].addEventListener('mouseleave', function() {
  //   preview.hide()
  // });

  function getPreviewImageUrl(time){
    // const roundedTime = Math.floor(time);
    // return `thumbnails/thumbnail_${roundedTime}.jpg`;
    return "../../assets/check.png"
  }
  //===============================================================
  const line2Box = $(".line2-box")


  // line2Box.append(`
  //   <div class="item2">
  //       <img src="../../assets/check.png"/>${crtItem.count}
  //   </div>
  //   <div class="item2">
  //       <img src="../../assets/point.png"/>${crtItem.point}
  //   </div>
  //   <div class="item2">
  //       <img src="../../assets/tap.png"/>${crtItem.tap}
  //   </div>
  //   <div class="item2">
  //       <img src="../../assets/like.png"/>喜欢
  //   </div>
  //   <div class="item2">
  //       <img src="../../assets/share.png" />
  //       <div class="share">分享
  //           <div class="prompt2">
  //               <div class="prompt2-item">分享</div>
  //               <div class="prompt2-item">
  //                   <img src="../../assets/qq.png"/>
  //                   <img src="../../assets/wx.png"/>
  //               </div>
  //               <div class="prompt2-item">复制链接</div>
  //               <div class="prompt2-item">
  //                   <input readonly class="share-input"/>
  //                   <img src="../../assets/copy.png"/>
  //               </div>
  //           </div>
  //       </div>
        
  //   </div>
  // `)
  const share = $(".share")
  const shareInput = $(".share-input")
  const prompt2 = $(".prompt2")
  var timeId = ""
  shareInput.val(crtItem.url)
  share.hover(
    function(){
  console.log("aa");
      
      if(timeId) clearTimeout(timeId)
      prompt2.show()
  },
    function(){
      timeId = setTimeout(()=>{
        prompt2.hide()
      },1000)
    })
  
  //============================================   
  const recommandBox = $(".recommand-box")
  function addCommand(){
    $.each(recommandList, (index, item) => {
      var listItem = `<div class="box">
                          <div class="video">
                              <video class="video-preview" muted preload="metadata">
                                  <source src="${item.url}" type="video/mp4">
                              </video>                 
                              <div class="clear">${item.clear}</div>
                              <div class="time">${item.time}</div>
                          </div>
                          <div class="text">
                          <div class="title" data-item='${JSON.stringify(item)}'>${item.title}</div>
                          <div class="l-title">
                                  <div class="left">
                                      <img src="../../assets/check.png">
                                      <div id="check">${item.count}</div>
                                  </div>
                                  <div class="right">
                                      <img src="../../assets/point.png"/>
                                      <div id="point">${item.point}</div>
                                  </div>
                              </div>
                          </div>
                      </div>`;
    recommandBox.append(listItem);
    })
  }
  // addCommand()
  recommandBox.on("click", ".title", function() {
    localStorage.setItem("crtItem",JSON.stringify($(this).data('item')))
    window.open("/pages/detail/detail.html")
    
  });
  //=================================================

  const recommandBtn = $(".recommand-btn")
  recommandBtn.click(function(){
    console.log("aa");
    
  recommandList.push(...recommandList)
  addCommand()
  })
})

$('.preview-container').on('mouseover', function() {
  $('.preview-container').hide();
});

// $('#video').on('mouseout', function() {
//   $('.preview-container').show();
// });