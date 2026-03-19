<!-- MODAL DE SUPPRESSION -->
<div id="deleteModal{{ $diplome->id }}" class="modal">
    <div class="modal-content" style="max-width: 450px; text-align: center;">
        <div class="modal-header" style="justify-content: center; border-bottom: none;">
            <div style="background: rgba(239, 68, 68, 0.1); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                <i class="fas fa-exclamation-triangle" style="color: var(--danger); font-size: 1.8rem;"></i>
            </div>
        </div>

        <h2 style="color: #fff; margin-bottom: 10px;">Confirmer la suppression</h2>
        <p style="color: var(--text-muted); margin-bottom: 25px; line-height: 1.5;">
            Êtes-vous sûr de vouloir supprimer le diplôme <br>
            <strong style="color: #fff;">"{{ $diplome->libelle_diplome }}"</strong> ? <br>
        </p>

        <form action="{{ route('diplomes.destroy', $diplome->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div style="display: flex; gap: 12px; justify-content: center;">
                <button type="button" class="btn-filter-resete" style="width: auto; padding: 0 25px;border-radius: 8px;" onclick="closeDeleteModal({{ $diplome->id }})">
                    Annuler
                </button>
                <button type="submit" class="btn-submit" style="background: var(--danger); color: #fff; margin: 0; width: auto; padding: 12px 25px;">
                    Supprimer
                </button>
            </div>
        </form>
    </div>
</div>
