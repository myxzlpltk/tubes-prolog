from pyquery import PyQuery
import json
import os.path
import urllib.request
from toolz import unique

mainHTML = PyQuery(url="http://mobilelegendscounters.com")

heroes = []
names = mainHTML('.card__name')
roles = mainHTML('.card__role')
images = mainHTML('.card__image-container')

_heroes = [names.eq(i).text().title() for i in range(len(names))]
for i in range(len(names)):
    heroes.append({
        'name': names.eq(i).text().title(),
        'role': roles.eq(i).text(),
        'image': os.path.basename(images.eq(i).attr('src')),
        'enemies': [],
        'stats': {}
    })

    # urllib.request.urlretrieve(f"http://mobilelegendscounters.com{images.eq(i).attr('src')}", f"images/{heroes[i]['image']}")

    heroHTML = PyQuery(url=f"http://mobilelegendscounters.com{names.eq(i).parent().attr('href')}")

    stats = heroHTML(".stats__stat-item")
    for j in range(len(stats)):
        heroes[i]['stats'][stats.eq(j).children().eq(0).text().title()] = stats.eq(j).children().eq(1).text()

    enemyNames = heroHTML(f".matchup-card_strong .matchup-card__champ-name-text")
    enemyScores = heroHTML(f".matchup-card_strong .matchup-card__score-number")
    enemyPercentages = heroHTML(f".matchup-card_strong .line-graph__up-vote-percent-number")
    for k in range(len(enemyNames)):
        heroes[i]['enemies'].append({
            'name': enemyNames.eq(k).text().title(),
            'diff': int(enemyScores.eq(k).text()),
            'percentage': float(enemyPercentages.eq(k).text())
        })

    _enemies = [enemy['name'] for enemy in heroes[i]['enemies']]
    for enemy in [item for item in _heroes if item not in _enemies and item != heroes[i]['name']]:
        heroes[i]['enemies'].append({'name': enemy, 'diff': 0, 'percentage': 50.00})
    heroes[i]['enemies'] = sorted(heroes[i]['enemies'], key=lambda x: x['diff'], reverse=True)
    heroes[i]['enemies'] = list(unique(heroes[i]['enemies'], key=lambda x: x['name']))

    print(f"{i+1} out of {len(names)}")

with open('data.json', 'w') as f:
    json.dump(heroes, f, indent=4)