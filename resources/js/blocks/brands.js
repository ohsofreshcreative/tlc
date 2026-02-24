const brandModals = () => {
  const triggers = document.querySelectorAll('.brand-modal-trigger');
  const modal = document.getElementById('brand-modal');
  const overlay = document.querySelector('.brand-modal-overlay');
  const closeButton = document.querySelector('.brand-modal-close');

  if (!triggers.length || !modal || !overlay || !closeButton) {
    return;
  }

  const modalImage = document.getElementById('modal-image');
  const modalTitle = document.getElementById('modal-title');
  const modalTxt = document.getElementById('modal-txt');
  const modalLink = document.getElementById('modal-link');

  const openModal = (data) => {
    // Populate modal content
    modalImage.src = data.imageUrl;
    modalImage.alt = data.imageAlt;
    modalTitle.textContent = data.title;
    // Decode base64 content for the text
    try {
      modalTxt.innerHTML = atob(data.txt);
    } catch (e) {
      console.error("Failed to decode base64 content:", e);
      modalTxt.innerHTML = '';
    }

    if (data.link) {
      modalLink.href = data.link;
      modalLink.classList.remove('hidden');
    } else {
      modalLink.classList.add('hidden');
    }

    // Show modal
    modal.classList.remove('translate-x-full');
    overlay.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  };

  const closeModal = () => {
    modal.classList.add('translate-x-full');
    overlay.classList.add('hidden');
    document.body.style.overflow = '';
  };

  triggers.forEach(trigger => {
    trigger.addEventListener('click', () => {
      const data = {
        imageUrl: trigger.dataset.imageUrl,
        imageAlt: trigger.dataset.imageAlt,
        title: trigger.dataset.title,
        txt: trigger.dataset.txt,
        link: trigger.dataset.link,
      };
      openModal(data);
    });
  });

  closeButton.addEventListener('click', closeModal);
  overlay.addEventListener('click', closeModal);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('translate-x-full')) {
      closeModal();
    }
  });
};

export default brandModals;	