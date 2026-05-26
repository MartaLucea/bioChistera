document.querySelectorAll('.faq-pregunta').forEach(btn => {
            btn.addEventListener('click', () => {
                const expanded = btn.getAttribute('aria-expanded') === 'true';
                document.querySelectorAll('.faq-pregunta').forEach(b => {
                    b.setAttribute('aria-expanded', 'false');
                    b.nextElementSibling.classList.remove('oberta');
                });
                if (!expanded) {
                    btn.setAttribute('aria-expanded', 'true');
                    btn.nextElementSibling.classList.add('oberta');
                }
            });
        });

        const tabs = document.querySelectorAll('.faq-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('actiu'));
                tab.classList.add('actiu');
                filtrarFAQ();
            });
        });

        document.getElementById('faq-search').addEventListener('input', filtrarFAQ);

        function filtrarFAQ() {
            const cat = document.querySelector('.faq-tab.actiu').dataset.cat;
            const text = document.getElementById('faq-search').value.toLowerCase().trim();
            let visibles = 0;

            document.querySelectorAll('.faq-grup').forEach(grup => {
                const coincideixCat = cat === 'totes' || grup.dataset.cat === cat;
                const contingut = grup.textContent.toLowerCase();
                const coincideixText = text === '' || contingut.includes(text);

                if (coincideixCat && coincideixText) {
                    grup.removeAttribute('hidden');
                    visibles++;
                } else {
                    grup.setAttribute('hidden', '');
                    const btn = grup.querySelector('.faq-pregunta');
                    btn.setAttribute('aria-expanded', 'false');
                    grup.querySelector('.faq-resposta').classList.remove('oberta');
                }
            });

            document.getElementById('faq-buit').style.display = visibles === 0 ? 'block' : 'none';
        }