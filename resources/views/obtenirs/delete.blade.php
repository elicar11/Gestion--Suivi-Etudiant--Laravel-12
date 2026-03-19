<!-- MODAL DE SUPPRESSION OBTENTION -->
<div id="deleteModalObtention{{ $obtenir->id }}" class="modal">
    <div class="modal-content" style="max-width: 450px; text-align: center;">
        <div class="modal-header" style="justify-content: center; border-bottom: none; padding-bottom: 0;">
            <div style="background: rgba(239, 68, 68, 0.1); width: 65px; height: 65px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                <i class="fas fa-trash-alt" style="color: var(--danger); font-size: 1.8rem;"></i>
            </div>
        </div>

        <h2 style="color: #fff; margin-bottom: 10px;">Supprimer l'attribution ?</h2>
        <p style="color: var(--text-muted); margin-bottom: 25px; line-height: 1.5; font-size: 0.95rem;">
            Voulez-vous vraiment retirer le diplôme <br>
            <strong style="color: var(--primary);">"{{ $obtenir->diplome->libelle_diplome }}"</strong> <br>
            à l'étudiant <strong style="color: #fff;">{{ $obtenir->etudiant->nom }} {{ $obtenir->etudiant->prenom }}</strong> ?
        </p>

        <form action="{{ route('obtenirs.destroy', $obtenir->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div style="display: flex; gap: 12px; justify-content: center;">
                <button type="button" class="btn-filter-resete" style="width: auto; padding: 0 30px; height: 46px;" onclick="closeDeleteModal({{ $obtenir->id }})">
                    Annuler
                </button>
                <button type="submit" class="btn-submit" style="background: var(--danger); color: #fff; margin: 0; width: auto; padding: 12px 25px;">
                    Supprimer
                </button>
            </div>
        </form>
    </div>
</div>
