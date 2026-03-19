<!-- MODAL DE SUPPRESSION ANNÉE -->
<div id="deleteAnneeModal{{ $annee->id }}" class="modal">
    <div class="modal-content" style="max-width: 450px; text-align: center;">
        <div class="modal-header" style="justify-content: center; border-bottom: none;">
            <div style="background: rgba(239, 68, 68, 0.1); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                <i class="fas fa-calendar-times" style="color: var(--danger); font-size: 1.8rem;"></i>
            </div>
        </div>

        <h2 style="color: #fff; margin-bottom: 10px;">Supprimer l'année ?</h2>
        <p style="color: var(--text-muted); margin-bottom: 25px; line-height: 1.5;">
            Êtes-vous sûr de vouloir supprimer l'année scolaire <br>
            <strong style="color: var(--primary);">"{{ $annee->libelle_annee }}"</strong> ? <br>
        </p>

        <form action="{{ route('annees.destroy', $annee->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div style="display: flex; gap: 12px; justify-content: center;">
                <button type="button" class="btn-filter-resete" style="width: auto; padding: 0 25px; height: 45px;border-radius: 8px;" onclick="closeDeleteModal({{ $annee->id }})">
                    Annuler
                </button>
                <button type="submit" class="btn-submit" style="background: var(--danger); color: #fff; margin: 0; width: auto; padding: 12px 25px;">
                    Supprimer
                </button>
            </div>
        </form>
    </div>
</div>
