# Como rodar o Projecto

1- Criar o banco de dados e.g `warker-db`

2 - copy .env.example => .env e setar as váriaveis(DB_USERNAME, DB_DATABASE,DB_PORT, DB_PASSWORD)

3- rodar o comando `php artisan key:generate` para gerar a APP_KEY

4- rodar o comando `php artisan migrate` para rodar as migrations e criar as tabelas no banco de dados

5- rodar o comando `php artisan db:seed --class=CitySeeder` caso queira inserir alguns dados fakes no banco de dados

6- rodar o comando `php artisan serve" para rodar a API`

7- Importar o ficheiro dentro do diretorio `warker-api\.insomnia\nome_do_ficheiro.json` lá no insomnia
