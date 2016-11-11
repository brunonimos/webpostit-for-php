Com o software X Editor Neo nota-se que:

-BMP é mais viável para esta tarefa porque possui padrões de hexes que outros tipos de imagens analisadas não possuem:


-As imagens dos post-its precisaram de modificação com os hexes 10;


-A gravação de letras é feita em horizontal, ou seja da direita para a esquerda;


-Uma gravação de uma linha de imagem pode gravar uma ou mais partes de várias letras que estejam no caminho;


-Fazer um map em xml de cada conjuto de hexes e lenght (distância entre um bloco de hexes e outro);


-Definir que, se uma distância for x porcento menor que a distância máxima, então não é uma segunda letra que vem, mas sim uma perna da mesma letra.


-Definir que, se a distância for igual, x porcento menor com limite ou maior, então é a próxima letra que vem.

Exemplo:

Letra A em imagem de 300px por 300px.

Distância 1=60 pares de hexes, próximo bloco=perna.

Distência 7=>60 pares de hexes, próxima linha.

-Adicionar no começo de cada bloco de hexe o identificador da letra (hexes de 61 à 7a [ver tabela de hexes]) a fim de facilitar a leitura dentro da imagem;


-Menos número de offset ("initialhex*2", ver no X Editor Neo com decimal) quer dizer ao sul;


-Maior número de offset ("initialhex*2", ver no X Editor Neo com decimal) quer dizer ao norte;


-Com isto foi possível a quebra de linha e o alinhamento das letras.


Dados importantes:
Padrão do desenho das letras na imagem de teste (<letra>.bmp):
width:100/250 px
Início: hex 1078*2