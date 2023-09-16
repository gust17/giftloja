<div class="container">
    <h2>Selecione uma Parceira</h2>
    @if (auth()->user()->parceira_selecionada)
        <div class="alert alert-warning">
            Você já está associado a uma parceira. Para fazer alterações, volte ao seu perfil.
        </div>
    @else
        <table class="table">
            <!-- Resto do código para listar as parceiras disponíveis -->
        </table>
    @endif
</div>
