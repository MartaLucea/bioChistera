  function obrirModalTutorial(id) {
    tutorialEditId = id || null;
    document.getElementById('tut-err').textContent = '';
    document.getElementById('modal-tut-titol').textContent = id ? 'Editar tutorial' : 'Nou tutorial';

    if (!id) {
      ['tut-titol','tut-cat','tut-nivell','tut-durada','tut-url','tut-desc']
        .forEach(i => document.getElementById(i).value = '');
    }
    document.getElementById('modal-tutorial').classList.add('open');
  }

  async function editarTutorial(id) {
    try {
      const res = await fetch(`${API}/tutorials/${id}`);
      const t = await res.json();
      document.getElementById('tut-titol').value  = t.titol;
      document.getElementById('tut-cat').value    = t.categoria;
      document.getElementById('tut-nivell').value = t.nivell;
      document.getElementById('tut-durada').value = t.durada_minuts;
      document.getElementById('tut-url').value    = t.video_url || '';
      document.getElementById('tut-desc').value   = t.descripcio || '';
      obrirModalTutorial(id);
    } catch(e) { alert('Error carregant el tutorial'); }
  }

  async function guardarTutorial() {
    const titol  = document.getElementById('tut-titol').value.trim();
    const cat    = document.getElementById('tut-cat').value;
    const nivell = document.getElementById('tut-nivell').value;
    const durada = parseInt(document.getElementById('tut-durada').value);
    const url    = document.getElementById('tut-url').value.trim();
    const desc   = document.getElementById('tut-desc').value.trim();
    const errEl  = document.getElementById('tut-err');

    if (!titol)        return errEl.textContent = 'El títol és obligatori.';
    if (!cat)          return errEl.textContent = 'Tria una categoria.';
    if (!nivell)       return errEl.textContent = 'Tria un nivell.';
    if (!durada || durada < 1) return errEl.textContent = 'La durada ha de ser un número positiu.';
    if (!url)          return errEl.textContent = 'La URL del vídeo és obligatòria.';
    if (!url.startsWith('http')) return errEl.textContent = 'La URL no és vàlida.';
    errEl.textContent = '';

    const body = { titol, categoria: cat, nivell, durada_minuts: durada, video_url: url, descripcio: desc, usuari: USUARI, aprovada: false };

    try {
      if (tutorialEditId) {
        await fetch(`${API}/tutorials/${tutorialEditId}`, {
          method: 'PUT',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(body)
        });
      } else {
        await fetch(`${API}/tutorials`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(body)
        });
      }
      tancarModals();
      carregarTutorials();
    } catch(e) { errEl.textContent = 'Error de connexió amb l\'API.'; }
  }

  async function eliminarTutorial(id) {
    if (!confirm('Segur que vols eliminar aquest tutorial?')) return;
    try {
      await fetch(`${API}/tutorials/${id}`, { method: 'DELETE' });
      carregarTutorials();
    } catch(e) { alert('Error eliminant el tutorial.'); }
  }

  function renderMaterials() {
    const llista = document.getElementById('llista-materials');
    if (!materials.length) {
      llista.innerHTML = '<div class="empty">Encara no has afegit cap material.<br>Comparteix el que tinguis!</div>';
      return;
    }
    llista.innerHTML = materials.map((m, i) => `
      <div class="mat-item">
        <div class="mat-info">
          <h3>${m.nom}</h3>
          <p>${m.categoria}${m.desc ? ' · ' + m.desc : ''}</p>
        </div>
        <span class="estat ${m.estat}">${m.estat}</span>
        <div style="display:flex;gap:6px;flex-shrink:0;">
          <button class="btn-edit" onclick="editarMaterial(${i})" style="padding:4px 10px;font-size:0.72rem;">Editar</button>
          <button class="btn-del"  onclick="eliminarMaterial(${i})" style="padding:4px 10px;font-size:0.72rem;">✕</button>
        </div>
      </div>
    `).join('');
  }

  function obrirModalMaterial(idx) {
    materialEditIdx = idx !== undefined ? idx : null;
    document.getElementById('mat-err').textContent = '';
    document.getElementById('modal-mat-titol').textContent = materialEditIdx !== null ? 'Editar material' : 'Nou material';

    if (materialEditIdx !== null) {
      const m = materials[materialEditIdx];
      document.getElementById('mat-nom').value   = m.nom;
      document.getElementById('mat-cat').value   = m.categoria;
      document.getElementById('mat-desc').value  = m.desc || '';
      document.getElementById('mat-estat').value = m.estat;
    } else {
      ['mat-nom','mat-cat','mat-desc','mat-estat'].forEach(i => document.getElementById(i).value = '');
    }
    document.getElementById('modal-material').classList.add('open');
  }

  function editarMaterial(idx) { obrirModalMaterial(idx); }

  function guardarMaterial() {
    const nom   = document.getElementById('mat-nom').value.trim();
    const cat   = document.getElementById('mat-cat').value;
    const desc  = document.getElementById('mat-desc').value.trim();
    const estat = document.getElementById('mat-estat').value;
    const errEl = document.getElementById('mat-err');

    if (!nom)   return errEl.textContent = 'El nom és obligatori.';
    if (!cat)   return errEl.textContent = 'Tria una categoria.';
    if (!estat) return errEl.textContent = 'Tria l\'estat.';
    errEl.textContent = '';

    const obj = { nom, categoria: cat, desc, estat };
    if (materialEditIdx !== null) {
      materials[materialEditIdx] = obj;
    } else {
      materials.push(obj);
    }
    localStorage.setItem('materials_' + USUARI, JSON.stringify(materials));
    tancarModals();
    renderMaterials();
  }

  function eliminarMaterial(idx) {
    if (!confirm('Segur que vols eliminar aquest material?')) return;
    materials.splice(idx, 1);
    localStorage.setItem('materials_' + USUARI, JSON.stringify(materials));
    renderMaterials();
  }

  function tancarModals() {
    document.querySelectorAll('.overlay').forEach(o => o.classList.remove('open'));
  }

  document.querySelectorAll('.overlay').forEach(o =>
    o.addEventListener('click', e => { if(e.target === o) tancarModals(); })
  );