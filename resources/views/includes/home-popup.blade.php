@push("css")


<style>

.modal-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: #222;
  position: relative;
  /* min-height: 100vh;
  background-color: #b3e6f4; */
}
.modalx {
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 0.4rem;
  width: 360px;
  padding: 1.3rem;
  min-height: 450px;
  /* position: absolute; */
  position: fixed;
  z-index: 9999;
  top: 100px;
  background-color: #000;
  border: 1px solid #000;
  border-radius: 15px;
}
.video-wrapper {
  height: 450px;
  overflow: hidden;
  display: flex;
  align-items: center;
}
.modalx .flex {
  display: flex;
  align-items: center;
  justify-content: flex-end;
}

.modalx input {
  padding: 0.7rem 1rem;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 0.9em;
}

.modalx p {
  font-size: 0.9rem;
  color: #777;
  margin: 0.4rem 0 0.2rem;
}
video {
  object-fit: contain!important;
}
/* .modalx button {
  cursor: pointer;
  border: none;
  font-weight: 600;
} */

/* .btn {
  display: inline-block;
  padding: 0.8rem 1.4rem;
  font-weight: 700;
  background-color: black;
  color: white;
  border-radius: 5px;
  text-align: center;
  font-size: 1em;
} */

.modalx .btn-open {
  position: absolute;
  bottom: 150px;
}

/* .modalx .btn-close {
  transform: translate(10px, -20px);
  padding: 0.5rem 0.5rem;
  margin-top: 10px;
  background: #eee;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
} */

.modalx .btn-close {
    transform: translate(60px, -72px);
    padding: 0.5rem 0.5rem;
    margin-top: 0px;
    position: relative;
    z-index: 9999;
    top: 20px;
    right: 25px;
    color: #fff;
    opacity: 1;
    margin-bottom: -45px;
    background: #66972b;
    top: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.overlayx {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(3px);
  z-index: 999;
}

.hiddenx {
  display: none;
}

#pjsfrrsplayer video {
  /* object-fit: scale-down!important; */
}

pjsdiv {
  border-radius: 10px;
}

@media screen and (max-width: 680px){
  .modalx {
  gap: 0.4rem;
  width: 95%;
  padding: 0.3rem;
  min-height: 300px;
  /* position: absolute; */
  position: absolute;
  z-index: 9999;
  top: 100px;
  background-color: #000;
  border: 1px solid #000;
  border-radius: 15px;
}

/* .but {
  margin-top: -55px;
} */
}
</style>
 
@endpush
<main class="modal-container">
<section class="modalx hiddenx">
  <div class="flex">
    <!-- <img src="https://avatars.githubusercontent.com/u/62628408?s=96&v=4" width="50px" height="50px" alt="user" /> -->
    <button id="btn-close" class="btn-close">⨉</button>
  </div>
  <div id="formr" style="display: none;">
  <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdOCYTYgSYp2nhTsBSPJGT4H83O2m3Fdw5SRcpTJpUXXki7vw/viewform?embedded=true" style="width: 100%;" height="520" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>

</div>
  <div id="but" >
  <div id="player" class="mb-3"></div>
    <!-- <h3>Stay in touch</h3>
    <p>
      This is a dummy newsletter form so don't bother trying to test it. Not
      that I expect you to, anyways. :)
    </p> -->
  </div>
  <!-- <input type="email" id="email" placeholder="brendaneich@js.com" /> -->
  <button id="clickToWin" class="btn btn-primary mt-1 btnn" onclick="loadGoogleForm()">Click to Win</button>
</section>
</main>
<div class="overlayx hiddenx"></div>

@push("scripts")
<script src="/ecom/assets/playerjs.js" type="text/javascript"></script>
<script>
   var player = new Playerjs({id:"player", file:"/videos/you-made-it.mp4", poster: "", fluid: false,  autoplay:1});
   var i = 0;
   var isEnded = false
function go () {
  if(player.api('time') >= 63){
    console.log(i);
    
    loadGoogleForm()
  }
    i++;

    setTimeout(go, 1000); // callback
}
go();
</script>
<script>


const modal = document.querySelector(".modalx");
const overlay = document.querySelector(".overlayx");
const openModalBtn = document.querySelector(".btxx");
const closeModalBtn = document.querySelector("#btn-close");

// close modal function
const closeModal = function () {
  modal.classList.add("hiddenx");
  overlay.classList.add("hiddenx");
  //var player = new Playerjs({id:"player", file:"/videos/you-made-it.mp4", killbutton:1});
  console.log('Player --')
  player.api("pause");
};

function loadGoogleForm(){
  $(".modalx").css('width',"100%")
  $(".modalx").css('max-width',"550px")
  $('#but').hide();$('#formr').show();$('.btnn').hide();$('.modalx').css('padding', '0!important;');$('iframe').contents().find('body').attr('style','zoom:90%;')
  player.api("pause");
  player.api("seek", 0);
}
// close the modal when the close button and overlay is clicked
closeModalBtn.addEventListener("click", closeModal);
overlay.addEventListener("click", closeModal);

// close modal when the Esc key is pressed
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape" && !modal.classList.contains("hiddenx")) {
    closeModal();
  }
});

// open modal function
const openModal = function () {
  modal.classList.remove("hiddenx");
  overlay.classList.remove("hiddenx");
  $('#but').show();
  $('#clickToWin').show();
  
  $('#formr').hide()
  $(".modalx").css('width',"360px")
  player.api("play");
};

// open modal event
// openModalBtn.addEventListener("click", openModal);
$(".btxx").click(openModal)
// $(".list a").click(openModal)
</script>

@endpush