from pyquery import PyQuery
import json
import os.path
import urllib.request

mainHTML = PyQuery(url="http://mobilelegendscounters.com")

heroes = []
names = mainHTML('.card__name')
roles = mainHTML('.card__role')
images = mainHTML('.card__image-container')
for i in range(len(names)):
    heroes.append({
        'name': names.eq(i).text().title(),
        'role': roles.eq(i).text(),
        'image': os.path.basename(images.eq(i).attr('src')),
        'strongs': [],
        'weaks': [],
        'stats': {}
    })

    urllib.request.urlretrieve(f"http://mobilelegendscounters.com{images.eq(i).attr('src')}", f"images/{heroes[i]['image']}")

    heroHTML = PyQuery(url=f"http://mobilelegendscounters.com{names.eq(i).parent().attr('href')}")

    stats = heroHTML(".stats__stat-item")
    for j in range(len(stats)):
        heroes[i]['stats'][stats.eq(j).children().eq(0).text().title()] = stats.eq(j).children().eq(1).text()

    for j, index in enumerate(['strongs', 'weaks']):
        enemyNames = heroHTML(f".matchups__list:eq({j}) .matchup-card__champ-name-text")
        enemyScores = heroHTML(f".matchups__list:eq({j}) .matchup-card__score-number")
        enemyPercentages = heroHTML(f".matchups__list:eq({j}) .line-graph__up-vote-percent-number")
        for k in range(5):
            heroes[i][index].append({
                'name': enemyNames.eq(k).text().title(),
                'score': enemyScores.eq(k).text(),
                'percentage': enemyPercentages.eq(k).text()
            })

    print(f"{i+1} out of {len(names)}")

with open('data.json', 'w') as f:
    json.dump(heroes, f, indent=4)