use Studyorganizer;

INSERT INTO Teacher (teacherId, name, is_active) VALUES 
(1, 'Michael Wenzina', true),
(2, 'Kurt Hohenauer', true);

INSERT INTO User (username, password_hash, created_at, updated_at) VALUES
('Felix Kiesling', 'einfach1', '2026-02-19', '2026-02-19'),
('Anton Pucalka', 'einfach1', '2026-02-19', '2026-02-19');

INSERT INTO Subjects (subjectId, name, teacherId) VALUES
(1, 'Deutsch', 2),
(2, 'INSY', 1);

INSERT INTO Homework (homeworkId, title, description, due_date, is_done, userId, subjectId, created_at, updated_at) VALUES
(1, 'Text-Aufgabe', 'hallo', '2026-02-17', true, 1, 1, '2026-02-15', '2026-02-15'),
(2, 'PHP', 'hallo', '2026-02-16', true, 2, 2, '2026-02-14', '2026-02-14');