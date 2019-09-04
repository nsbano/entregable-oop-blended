<?php

	abstract class DB
	{
		public static function getAllMovies()
		{
			global $connection;

			$stmt = $connection->prepare("
				SELECT m.id AS 'movie_id', m.title, m.rating, m.awards, m.release_date, m.length, g.name AS 'genre', m.genre_id
				FROM movies as m
				LEFT JOIN genres as g
				ON g.id = m.genre_id
				ORDER BY m.title;
			");

			$stmt->execute();

			$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$moviesObject = [];

			foreach ($movies as $movie) {
				$finalMovie = new Movie($movie['title'], $movie['rating'], $movie['awards'], $movie['release_date']);

				$finalMovie->setLength($movie['length']);
				$finalMovie->setGenreID($movie['genre_id']);
				$finalMovie->setGenreName($movie['genre']);
				$finalMovie->setId($movie['movie_id']);
				$moviesObject[] = $finalMovie;
			}


			return $moviesObject;
		}

		public static function getAllGenres()
		{
			global $connection;

			$stmt = $connection->prepare(" SELECT id, name, ranking, active FROM genres");

			$stmt->execute();

			$genres = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$genresObject = [];

			foreach ($genres as $genre) {
				$finalGenre = new Genre($genre['name'], $genre['ranking'], $genre['active']);

				$finalGenre->setID($genre['id']);

				$genresObject[] = $finalGenre;
			}

			return $genresObject;
		}

		public static function saveMovie(Movie $movie)
		{
			global $connection;

			try {
				$stmt = $connection->prepare("
					INSERT INTO movies (title, rating, awards, release_date, length, genre_id)
					VALUES(:title, :rating, :awards, :release_date, :length, :genre_id)
				");


				$stmt->bindValue(':title', $movie->getTitle());
				$stmt->bindValue(':rating', $movie->getRating());
				$stmt->bindValue(':awards', $movie->getAwards());
				$stmt->bindValue(':release_date', $movie->getReleaseDate());
				$stmt->bindValue(':length', $movie->getLength());
				$stmt->bindValue(':genre_id', $movie->getGenreID());

				$stmt->execute();

				return true;
			} catch (PDOException $exception) {
				return false;
			}
		}

		public static function saveGenre(Genre $genre)
		{
			global $connection;

			$genres = self::getAllGenres();

			$finalGenres = [];

			foreach ($genres as $oneGenre) {
				$finalGenres[] = $oneGenre->getName();
			}

			if (!in_array($genre->getName(), $finalGenres)) {
				$stmt = $connection->prepare("
					INSERT INTO genres (name, ranking, active)
					VALUES(:name, :ranking, :active)
				");

				$stmt->bindValue(':name', $genre->getName());
				$stmt->bindValue(':ranking', $genre->getRanking());
				$stmt->bindValue(':active', $genre->getActive());

				$stmt->execute();

				return true;
			} else {
				return false;
			}

			public static function getAllActors() {
				global $connection;

				$stmt = $connection->prepare("
					SELECT a.id AS 'actors_id', a.name, a.apellido, m.title AS pelicula
					FROM actors as a
					LEFT JOIN movies as m
					ON m.id = a.peliculaId
					ORDER BY a.apellido;
				");

				$stmt->execute();

				$actors = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$moviesObject = [];

				foreach ($actors as actor) {
					$finalActor = new Actor($actor['name'], $actor['apellido'], $actor['pelicula']);

					$finalActor->setId($actor['pelicula']);
					$actorsObject[] = $finalActor;
				}


				return $actorObject;
			}
			public static function saveActor(Actors $actor)
			{
				global $connection;

				$actors = self::getAllActors();

				$finalActors = [];

				foreach ($actors as $actor) {
					$finalActors[] = $actor->getName() . $actor->getApellido();
				}

				if (!in_array($actor->getName() . $actor->getApellido(), $finalActors)) {
					$stmt = $connection->prepare("
						INSERT INTO actors (name, apellido, pelicula)
						VALUES(:name, :apellido, :pelicula)
					");

					$stmt->bindValue(':name', $actor->getName());
					$stmt->bindValue(':apellido', $actor->getApellido());
					$stmt->bindValue(':pelicula', $actor->getPelicula());

					$stmt->execute();

					return true;
				} else {
					return false;
				}
		}
	}
