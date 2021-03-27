<script>
    // ALERT - ANIMATION
    $('.page-alert').hide(5000);

    // Execute func init pada saat DOM berhasil di load
    window.addEventListener('DOMContentLoaded', () => init())

    // Function yang di execute nya
    init = () => {
        toggleRadioButton('.rad-btn', 'ketPelapor', 'btnRadio')
        toggleRadioButton('.btn-rad', 'txtPelapor', 'Radio', () => {
            if (document.getElementById('txtPelapor').value != 'ANONYMOUS') {
                document.getElementById('txtPelapor').readOnly = false
                document.getElementById('txtPelapor').value = ''
                document.getElementById('txtPelapor').focus();


            } else {
                document.getElementById('txtPelapor').readOnly = true
            }
        })
    }

    toggleRadioButton = (kelas, input, classToggle, callback) => {
        let rads = document.querySelectorAll(kelas)


        // Karna Output array jadi di perulangan
        rads.forEach((rad, id) => {

            //Masing masing radio button dari let rads di beri event listener
            rad.addEventListener('click', e => {
                // Merubah isi input dengan value dari radio button
                document.getElementById(input).value = rad.innerText
                // Membuat radio button yang di click menjadi checkedki9jmi8ojmh
                rad.childNodes[1].checked = true
                // Untuk toggle button radio lainnya menjadi false
                let dd = id == 0 ? 2 : 1;
                document.getElementById(`${classToggle}${dd}`).checked = false

                if (typeof callback !== 'undefined') {
                    callback()
                    // console.log('cs')
                }
            })
        })
    }
</script>