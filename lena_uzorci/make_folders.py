import os

cwd = os.getcwd()
for i in range(71, 101):
	directory = f"{i}"
	if not os.path.exists(directory):
		os.mkdir(os.path.join(cwd, directory))