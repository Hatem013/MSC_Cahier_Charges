const progressbar = document.querySelector('.progressbar');
const progressbarItems = progressbar.querySelectorAll('li');
const progress = document.querySelector('.progress');

progressbarItems.forEach((item, index) => {
  if (index <= progressbarItems.length - 2) {
    item.classList.add('with-progress');
  }
});

function updateProgress() {
  const activeItem = progressbar.querySelector('.active');
  const activeItemIndex = Array.from(progressbarItems).indexOf(activeItem);

  if (activeItemIndex >= 0) {
    const progressWidth = (100 / (progressbarItems.length - 1)) * activeItemIndex;
    progress.style.width = `${progressWidth}%`;
  }
}

updateProgress();