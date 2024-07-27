@auth
    @extends('layouts.navbar')
    @section('title',"Özel Gereksinim")
    @section('sidebar_permission')
        @include('admin.admin_navbar_content')
    @endsection
    @section('icerik')
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Özel Gereksinim Başarıyla Kaydedildi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                            Özel Gereksinim Başarıyla Silindi!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h1>Özel Gereksinim</h1>
                    <hr>
                    <button type="button" class="btn btn-success"  onclick="window.location='{{ route('disabilities.create') }}'">Yeni Gereksinim Düzey Ekle</button>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Kodu</th>
                            <th>Özel Gereksinim</th>
                            <th>İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($disabilities as $disability)
                            <tr>
                                <td>{{ $disability->id }}</td>
                                <td>{{ $disability->name }}</td>
                                <td>
                                    <button id="settingsButton" class="btn btn-secondary" class="settings-btn"  data-toggle="modal" data-target="#addTermModal">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <a  class="btn btn-primary" href="{{ route('disabilities.edit', $disability->id) }}">Düzenle</a>
                                    <form action="{{ route('disabilities.destroy', $disability->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="settingsModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2>Ayarlar</h2>
                <form>
                    <label><input type="checkbox" name="setting1"> Ayar 1</label><br>
                    <label><input type="checkbox" name="setting2"> Ayar 2</label><br>
                    <label><input type="checkbox" name="setting3"> Ayar 3</label><br>
                    <label><input type="checkbox" name="setting4"> Ayar 4</label><br>
                    <label><input type="checkbox" name="setting5"> Ayar 5</label><br>
                </form>
            </div>
        </div>
        <div class="modal fade" id="addTermModal" tabindex="-1" aria-labelledby="addTermModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTermModalLabel">Grup Ayarları</h5>
                    </div>
                    <div class="modal-body">
                        <h5>Testte gelecek menüleri seçiniz:</h5>
                        <form>
                            <label><input type="checkbox" name="sozluk">Sözlük bağlantısı</label><br>
                            <label><input type="checkbox" name="metin">Metin sentezleyici</label><br>
                            <label><input type="checkbox" name="renk">Renk</label><br>
                            <label><input type="checkbox" name="karsi">Karşıtlık</label><input type="range" name="setting3"><br>
                            <label><input type="checkbox" name="zoom">Büyüteç</label><input type="range" name="setting3"><br>
                            <label><input type="checkbox" name="ses">Ses Ayarları</label><input type="range" name="setting3"><br>
                            <label><input type="checkbox" name="tekrat">Tekrar Seçenekleri </label><br>
                            <label><input type="checkbox" name="kayıt">Maddenin Ses Kaydını Ekle</label><br>
                            <label><input type="checkbox" name="hesap">Konuşan Hesap makinesi</label><br>
                            <label><input type="checkbox" name="yanıt">Yanıtlama Seçenekleri</label><br>
                            <label style=" padding-left: 20px;"><input type="radio" name="setting5">Sesle Yanıt(Speech to text)</label><br>
                            <label style=" padding-left: 20px;"><input type="radio" name="setting5">Klavyeden (A, B, C, D)</label><br>
                            <label style=" padding-left: 20px;"><input type="radio" name="setting5" checked>Tıklayarak (varsayılan)</label><br>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endauth

