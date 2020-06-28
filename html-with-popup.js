'use strict';
(function() {
  class PopupDialog {
    constructor() {
      this.isPopupOpen = false;
      this.popupPodium = document.querySelector('.popup-podium');
      this.popupContainer = document.querySelector('.popup-container');
      this.popupContent = document.querySelector('.popup-content');
      this.overlayPodium = document.querySelector('.overlay-podium');
      this.popupCloseBtn = document.querySelector('.popup-close-btn');
      
      this.overlayPodium.addEventListener('click', this.popupBtnHandler.bind(this));
      this.popupCloseBtn.addEventListener('click', this.popupBtnHandler.bind(this));
    }
    loadPopupContent(url) {
      return fetch(url)
        .then(response => response.json());
    }
    popupBtnHandler() {
      if (this.isPopupOpen) {
        this.popupPodium.classList.remove('visible');
        this.overlayPodium.classList.remove('visible');
      } else {
        this.loadPopupContent(apiUrl)
          .then(data => {
            this.popupContent.innerHTML = data.text;
            this.popupPodium.classList.add('visible');
            this.overlayPodium.classList.add('visible');
          });
      }
      this.isPopupOpen = !this.isPopupOpen;
    }
  }

  
  const loadPage = () => {
    const popupDialog = new PopupDialog();
    const popupBtn = document.querySelector('#popup-btn');
    popupBtn.addEventListener('click', popupDialog.popupBtnHandler.bind(popupDialog));
  }
  
  window.addEventListener('DOMContentLoaded', (event) => {
    loadPage();    
  });
})()
