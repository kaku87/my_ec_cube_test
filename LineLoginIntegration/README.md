# EC-CUBE3 x LINEログイン連携プラグインご利用ガイド

## 概要

EC-CUBE3に以下の機能を追加するプラグインです

* LINEログイン

## バージョン情報

### 本ドキュメントのバージョン情報

* 2018年4月16日 1.0.0

### 対応するプラグインのバージョン情報

* 2018年4月16日 1.0.0

## 本資料について

* 本資料の著作権は「[株式会社イーツー・インフォ](https://www.e2info.co.jp/)(以下、弊社と記載)」に帰属します
* 本資料のいかなる部分においても、弊社に事前の許可なく、電子的、機械的を含むいかなる手段や形式によってもその複製、改変、頒布、ならびにそれらに類似する行為を禁止します。
* 本資料の内容は、予告なく随時更新されます。

### 商標について

* EC-CUBEは株式会社ロックオンの商標または登録商標です。 
* LINEはLINE株式会社の商標または登録商標です。 

### 注意事項

* プラグインに同梱されているLINEログインボタンを利用するには、[Usage Guidelines for the LINE Login Button](https://terms2.line.me/LINE_Developers_Guidelines_for_Login_Button)を読み、内容に同意する必要があります。ご利用者様のサイトで利用することにより、ガイドラインに同意したものとみなされます。
* 何らかの事情によりガイドラインに同意できない場合、または独自の画像を利用する場合は、同梱の画像を差し替えてご利用ください。

## はじめに

1. ご利用前に、以下のURLを参照し、環境が要件を満たしていることを確認してください
    2. [EC-CUBE3.0システム要件](http://doc.ec-cube.net/quickstart_requirement)
3. 導入作業前に、必ず設置済みのすべてのプログラム、ファイル、データのバックアップを取得してください。導入によるプログラムやデータの破損など一切の責任は負いかねます。
4. EC-CUBE（本体）に関するお問合せにつきましては、下記「開発コミュニティ」をご利用ください。
    5. [開発コミュニティ](http://xoops.ec-cube.net/)
6. EC-CUBE3xLINEログイン連携プラグインのご利用にはLINE Developersアカウントの登録が必要です。下記「LINE developers」よりアカウントをご用意ください。
    7. [LINE developers](https://developers.line.me/ja/)
    8. 参考資料：[LINEログインを利用するには](https://developers.line.me/ja/docs/line-login/getting-started/)
9. プラグインの導入手順・ご利用方法についてのお問い合わせには対応しておりません。自己責任でのご利用をお願いいたします。
10. 有料でのカスタマイズ・サポートの対応につきましては、[弊社ウェブサイト](https://www.e2info.co.jp/)よりお問い合わせください。

## プラグインの導入

### 導入までの流れ

1. LINE Developerアカウント登録
2. プラグインのダウンロードとインストール
3. プラグインの初期設定
4. 動作確認

### 1. LINE Developerアカウント登録と、チャンネルの開設

* EC-CUBE3xLINEログイン連携プラグインのご利用にはLINE Deveroperアカウントが必要です。
* LINE Deveroperアカウントはウェブブラウザの操作のみで無料で取得することができます（2018年4月現在）下記のURLより、登録手続きをおこなってください。
    * [LINE developers](https://developers.line.me/ja/)
* 以下に手順を記載します。

#### 1-1. LINE Developersアカウントの登録

* 下記のURLより、LINE Developersアカウントを登録します。
    * [LINE Developers](https://developers.line.me/ja/)

#### 1-2. LINEログイン用プロバイダーの作成

* 下記のURLより、LINE Developersアカウントでログインし、プロバイダーを作成します。
    * [新規channel作成](https://developers.line.me/console/register/line-login/provider/)

#### 1-3. リダイレクト先設定

* 下記のURLを参考に、リダイレクトURLを設定します。
    * [ウェブアプリにLINEログインを組み込む](https://developers.line.me/ja/docs/line-login/web/integrate-line-login/)
        * 「チャネルを設定する - リダイレクト先を設定する」を参照

設定内容

~~~
【EC-CUBEが設置されているURL】plugin/line_login_callback
~~~

例

~~~
https://example.com/plugin/line_login_callback
~~~


#### 1-4. Channel ID、Channel Secretの取得

* LINEコンソールより、プロバイダーのChannel ID、Channel Secretを取得します。
* 取得した情報は、後続の手順で、EC-CUBE管理画面より設定します。


### 2. プラグインのダウンロードとインストール

* [EC-CUBE OWNERS STORE](http://www.ec-cube.net/owners/)より、EC-CUBE3 x LINEログイン連携プラグインを購入してください。
* 購入が完了すると、EC-CUBE管理画面よりプラグインをインストールできるようになります。手順に沿ってインストールしてください。
* プラグインのインストールが完了すると、EC-CUBE管理画面に「LINE管理」が追加されます。

### 3. プラグインの初期設定

* EC-CUBE管理画面より、「LINE管理」→「ログイン設定」と選択します。Channel IDとChannel Secretの入力フォームが表示されるので、LINEコンソールより取得した情報を設定して保存するボタンを押します。

### 4. 動作確認

* 以下の確認をおこなってください。
    * EC-CUBE管理画面
        * LINE管理メニューが表示されることを確認
    * EC-CUBE通販画面
        * 新規会員登録画面
            * LINEログインボタンが表示されること
            * LINEログインボタンを押すとLINEログイン画面が表示されログインできること
            * LINEログイン後、EC-CUBEの会員登録画面が再度表示され、そのまま会員登録ができること
        * ログイン画面
            * LINEログインボタンが表示されること
            * LINEログインボタンを押すとLINEログイン画面が表示されログインできること
            * LINEログイン後、EC-CUBEログイン状態になること
        

---------------------------------------

Copyright(C) E2info, Inc. All Rights Reserved.
