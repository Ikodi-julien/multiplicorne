export const handleProfilToggle = {

  elementsSelector: [
    ['.avatarProfil', '#avatarProfilToggle'],
    ['.decorProfil', '#decorProfilToggle'],
    ['.photoProfil', '#photoProfilToggle'],
    ['.birthDateProfil', '#birthDateProfilToggle'],
    ['.pseudoProfil', '#pseudoProfilToggle'],
    ['.emailProfil', '#emailProfilToggle'],
    ['.passProfil', '#passProfilToggle']
  ],

  addListenerToElt: () => {
    for (const tuple of handleProfilToggle.elementsSelector) {

      const first = document.querySelector(tuple[0]);
      const second = document.querySelector(tuple[1]);

      second.addEventListener('click', () => {
        first.classList.toggle('extend');
        first.classList.toggle('shrink');
      })
    }
  }
}
