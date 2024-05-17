
class LinkedSelect {

    /**
     * @param {HTMLSelectElement} $select
     */
    constructor ($select) {
      this.$select = $select
      this.$target = document.querySelector(this.$select.dataset.target)
      // Recuperer le premier element
      this.$placeholder = this.$target.firstElementChild
      this.onChange = this.onChange.bind(this)
      //détecter quand est ce la valeur change
      this.$select.addEventListener('change', this.onChange)
    }
      /**
   * Se déclenche au changement de valeur d'un select
   * @param {Event} e
   */
onChange(e) {
    if (e.target.value === '0') {
      return
    }
    // On recupère les données en Ajax
    let request = new XMLHttpRequest()
    // URl 
    request.open('GET', this.$select.dataset.source.replace('$id', e.target.value), true)
    // lorsque l'appel Ajax sera  fini
    request.onload = () => {
        //Verifier que le statue est correct (ex:404 ->la page n'a pas ete trouve)
      if (request.status >= 200 && request.status < 400) {
        let data = JSON.parse(request.responseText)
        let options = data.reduce(function (acc, option) {
          return acc + '<option value="' + option.value + '">' + option.label + '</option>'
        }, '')
        this.$target.innerHTML=options
        this.$target.insertBefore(this.$placeholder,this.$target.firstChild)
        this.$target.selectedIndex=0
      } else {
        alert('Impossible de charger la liste')
      }
    }
    //Lorseque le chargement echoue
    request.onerror = function () {
      alert('Impossible de charger la liste')
    }
    //Appeler le requet
    request.send()
  }
}





let $selects = document.querySelectorAll('.linked-select')

$selects.forEach(function ($select) {
    //construire un nouveau select link
    new LinkedSelect($select)
})