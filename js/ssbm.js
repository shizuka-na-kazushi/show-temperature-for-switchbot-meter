
(function() {
  let a = 'this is ssbmscript!'
  let d = document

  function set_image_type_id(type_id) {
    let spans = d.querySelectorAll('.ssbm-image-type')
    spans.forEach((e) => {e.textContent = `type='${type_id}'`})
  }

  d.addEventListener('DOMContentLoaded', (event) => {
    let radios = d.querySelectorAll('input[name="switchbot-meter-thumb-radio"]')
    radios.forEach((radio) => {
      radio.addEventListener('click', (e) => {
        set_image_type_id(radio.value)
      })
    })
  })
})()

