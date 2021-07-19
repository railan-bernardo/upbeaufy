

function click(element, open, close, select) {
  let el = document.querySelector(element);
  let selected = document.querySelector(select)
  let openN = document.querySelector(open)
  let closed = document.querySelector(close)

  el.addEventListener('click', event => {
    el.classList.toggle('open_active');
    openN.classList.toggle('i_open_ac');
    closed.classList.toggle('i_close_ac');
    selected.classList.toggle('main_ul_mobil_close');
  });
}

click('.open_nav', '.i_open', '.i_close', '.main_ul_mobil');

