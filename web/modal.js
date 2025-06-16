
function showModal(msg, redirect=null){
  const overlay = document.createElement('div');
  overlay.id='modalOverlay';
  overlay.innerHTML = '<div id="modalBox"><p>'+msg+'</p><button id="modalOk">OK</button></div>';
  document.body.appendChild(overlay);
  setTimeout(()=>overlay.classList.add('show'),50);
  overlay.querySelector('#modalOk').onclick = ()=> {
     overlay.remove();
     if(redirect) window.location = redirect;
  };
}
