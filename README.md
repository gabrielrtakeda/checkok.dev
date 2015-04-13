# Checkok: Conversão de Temperatura

## clone
Clone o repositório para um local específico do seu computador via linha de comando.

    git clone https://github.com/gabrielrtakeda/checkok.dev.git

ou baixe o **.zip** e instale manualmente [aqui](https://github.com/gabrielrtakeda/checkok.dev/archive/master.zip).

E renomeie o diretório extraído para **checkok.dev**.

## host
Adicionar as seguintes linhas em **/etc/hosts**:

    # Checkok Teste Prático
    127.0.0.1       checkok.dev


## vhost
Adicionar o seguinte bloco de código no arquivo de configuração de Virtual Host:

Substitua o **${rootDirectory}** para o caminho do seu htdocs em **DocumentRoot** e **Directory**.

Substitua o **${apachePort}** para uma porta específica, ou para **80**.

    <VirtualHost 127.0.0.1:${apachePort}>
        DocumentRoot ${rootDirectory}/checkok.dev/public
        ServerName checkok.dev
        SetEnv APPLICATION_ENV development
        <Directory ${rootDirectory}/checkok.dev/public>
                Options Indexes FollowSymLinks MultiViews
                AllowOverride All
                Order allow,deny
                allow from all
        </Directory>
    </VirtualHost>

## banco de dados
*  Execute as queries que estão em **checkok.dev/database.sql** para criação do banco de dados e tabela.
*  Em seguida altere as configurações em **checkok.dev/config/database.config.php**:
    * host
    * username
    * password

## pronto para usar
Acesse <http://checkok.dev/> em seu browser para visualizar.
*   Observação: Se você usar uma porta específica para o Apache não se esqueça de utilizá-la. (ex: <http://checkok.dev:8180/>)
