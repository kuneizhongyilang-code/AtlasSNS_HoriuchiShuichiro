<x-login-layout>

    <div class="post-page">

        {{-- 成功メッセージ --}}
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        {{-- バリデーションエラー --}}
        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- 投稿フォーム --}}
        <div class="post-form">

            <div class="post-user-icon">
                <img src="{{ asset('images/icon1.png') }}" alt="ユーザーアイコン">
            </div>

            <form action="{{ route('posts.store') }}" method="POST">
                @csrf

                <textarea
                    name="post"
                    maxlength="150"
                    placeholder="投稿内容を入力してください"
                >{{ old('post') }}</textarea>

                <div class="post-form-bottom">
                    <span class="character-count">150文字以内</span>

                    <button type="submit" class="post-button">
                      <img src="{{ asset('images/post.png') }}" alt="投稿">
                    </button>
                </div>
            </form>

        </div>


        {{-- 投稿一覧 --}}
        <div class="post-list">

            @forelse ($posts as $post)

                <div class="post-item">

                    <div class="post-item-header">

                        <div class="post-user-icon">
                            <img src="{{ asset('images/icon1.png') }}" alt="ユーザーアイコン">
                        </div>

                        <div class="post-user-info">
                            <p class="post-user-name">
                                {{ $post->name }}
                            </p>

                            <p class="post-date">
                                {{ $post->created_at }}
                            </p>
                        </div>

                    </div>

                    <div class="post-content">
                        {{ $post->post }}
                    </div>

                    {{-- 自分の投稿だけ編集・削除 --}}
                    @if ($post->user_id == auth()->id())

                        <div class="post-actions">

                            {{-- 編集 --}}
                            <button
                                type="button"
                                class="edit-button"
                                onclick="openEditModal(
                                    {{ $post->id }},
                                    @js($post->post)
                                )"
                            >
                                編集
                            </button>

                            {{-- 削除 --}}
                            <form
                                action="{{ route('posts.destroy', $post->id) }}"
                                method="POST"
                                class="delete-form"
                                onsubmit="return confirm('この投稿を削除しますか？');"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete-button">
                                  <img src="{{ asset('images/trash.png') }}" alt="投稿">
                                </button>
                            </form>

                        </div>

                    @endif

                </div>

            @empty

                <p class="no-post">
                    まだ投稿がありません。
                </p>

            @endforelse

        </div>

    </div>


    {{-- 編集モーダル --}}
    <div id="edit-modal" class="edit-modal">

        <div class="edit-modal-background" onclick="closeEditModal()"></div>

        <div class="edit-modal-content">

            <h3>投稿を編集</h3>

            <form id="edit-form" method="POST">

                @csrf
                @method('PUT')

                <textarea
                    id="edit-post"
                    name="post"
                    maxlength="150"
                ></textarea>

                <div class="edit-modal-buttons">

                    <button
                        type="button"
                        onclick="closeEditModal()"
                    >
                        キャンセル
                    </button>

                    <button type="submit">
                        保存
                    </button>

                </div>

            </form>

        </div>

    </div>


    <script>

        // 編集モーダルを開く
        function openEditModal(id, post) {

            const modal = document.getElementById('edit-modal');
            const textarea = document.getElementById('edit-post');
            const form = document.getElementById('edit-form');

            textarea.value = post;

            form.action = '/posts/' + id;

            modal.classList.add('open');
        }


        // 編集モーダルを閉じる
        function closeEditModal() {

            const modal = document.getElementById('edit-modal');

            modal.classList.remove('open');
        }

    </script>

</x-login-layout>
