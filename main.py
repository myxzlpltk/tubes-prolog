import json
import pandas
import numpy

# Resource
f = open("data.json")
data = json.load(f)

# Enemies
enemies = ["Layla", "Akai", "Nana", "Hayabusa", "Fanny"]

temp = {}
for hero in data:
    temp[hero['name']] = {}
    for enemy in hero['enemies']:
        temp[hero['name']][enemy['name']] = enemy['percentage']

data = pandas.DataFrame(temp).sort_index().transpose()

filtered_data = data.loc[set(data.index) - set(enemies)][enemies].sort_index()
gmeans = pandas.Series({}, dtype='float64')
for hero in filtered_data.index:
    gmeans[hero] = numpy.exp(numpy.log(filtered_data.loc[hero]).mean())

print(gmeans.sort_values(ascending=False))